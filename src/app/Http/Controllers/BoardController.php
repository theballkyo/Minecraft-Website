<?php
/**
 * Created by PhpStorm.
 * User: theba
 * Date: 1/9/2017
 * Time: 7:17 PM
 */
namespace App\Http\Controllers;

use App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class BoardController extends Controller
{
    public function __construct() {
        $this->middleware('auth', ['except' => [
            'index',
            'show',
        ]]);
    }

    /**
     * Show all topics
     * @param  Request  $request
     *
     * @return Response
     */
    public function index(Request $request) {
        $datas = Cache::remember('topic.all.' . $request->cat, 1, function () use ($request) {
            $cat = (int) $request->cat;
            $topics = $this->getAllTopics($cat);
            $category = App\Category::all();
            $catName = collect($category)->where('id', $cat);

            if ($catName->isNotEmpty()) {
                $catName = $catName->first()->title;
            } else if (!empty($cat)) {
                return [];
            }

            return ['topics' => $topics, 'category' => $category, 'cat' => $cat, 'catName' => $catName];
        });

        if (empty($datas)) {
            return redirect('/board');
        }
        return view('board.index', $datas);
    }

    /**
     * Get all topics is active
     *
     * @param int $category
     *
     * @return mixed
     */
    private function getAllTopics(int $category) {
        $topics = App\Topic::with('user', 'category')->orderBy('status', 'desc')->orderBy('updated_at', 'desc')->active();

        if(!empty($category)) {
            $topics->where('category_id', $category);
        }

        return $topics->get();
    }

    /**
     * Show the topic
     *
     * @param  Request  $request
     * @param  Int      $id       Topic Id
     * @return Response
     */
    public function show(Request $request, $id) {

        $datas = Cache::remember('topic.' . $id, 1, function () use ($request, $id){
            $topic = App\Topic::with('comment', 'comment.user')->where('id', $id)->first();

            if (empty($topic)) {
                return view('errors.topic404');
            }

            $headerTitle = 'Minecraft SkyRack - ' . $topic->title;
            $headerDescription = strip_tags($topic->body);

            $headerDescription = trim(preg_replace('/\s+/', ' ', $headerDescription));
            // Remove &nbsp;
            $headerDescription = str_replace("\xc2\xa0",' ',$headerDescription);

            return compact('topic', 'headerTitle', 'headerDescription');
        });

        return view('board.show', $datas);
    }

    /**
     * Show create topic page
     *
     * @return Response
     */
    public function create() {
        $category = App\Category::all();
        return view('topic.create', ['category' => $category]);
    }

    /**
     * Store the topic
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request) {
        $this->validate($request, [
            'title' => 'required|max:128|min:12',
            'body' => 'required|min:32',
            'category' => 'required|exists:category,id',
        ], [
            'title.*' => 'หัวข้อต้องมีความยาว 12-128 ตัวอักษร',
            'body.*' => 'เนื้อหาต้องมีความยาวไม่น้อยกว่า 32 ตัวอักษร',
            'category.*' => 'กรุณาเลือกหมวดหมู่ด้วย',
        ]);

        $topic = new App\Topic;

        $topic->title = $request->title;
        $topic->body = clean($request->body);
        $topic->user_id = $request->user()->id;
        $topic->category_id = $request->category;

        $topic->save();

        return redirect()->action('BoardController@show', ['id' => $topic->id]);
    }

    /**
     * Redirect reply if not have ID topic to reply
     *
     * @param  Request  $request
     * @return Response
     */
    public function replyRedirect(Request $request) {
        return redirect()->action('BoardController@index');
    }

    /**
     * Show reply page
     *
     * @param Request $request
     * @param int @id
     * @return Response
     */
    public function reply(Request $request, int $id) {
        $topic = App\Topic::find($id);

        if (empty($topic)) {
            return view('topic.notFound');
        }

        return view('topic.reply', ['topic' => $topic]);
    }

    /**
     * Store reply of topic
     *
     * @param Request $request
     * @return Response
     */
    public function storeReply(Request $request) {
        $this->validate($request, [
            'body' => 'required|min:8|max:512',
            'id' => 'required',
        ], [
            'body.*' => 'เนื้อหาต้องมีความยาว 8-512 ตัวอักษร',
        ]);

        $topic = App\Topic::find($request->id);

        if (empty($topic)) {
            return view('topic.notFound');
        }

        if (!$topic->canReply()) {
            return redirect()->action('BoardController@show', ['id' => $topic->id]);
        }

        $comment = new App\Comment;

        $comment->user_id = $request->user()->id;
        $comment->body = clean($request->body);
        $comment->topic_id = $topic->id;

        $comment->save();

        return redirect()->action('BoardController@show', ['id' => $topic->id]);
    }

    /**
     * Show edit topic page
     *
     * @param  Request  $Request
     * @param  Int      $id
     * @return Response
     */
    public function edit(Request $request, $id) {
        $topic = App\Topic::find($id);

        if (empty($topic)) {
            return view('topic.notFound');
        }

        if (!$topic->canEdit()) {
            return redirect()->action('BoardController@show', ['id' => $topic->id]);
        }

        return view('topic.edit', ['topic' => $topic]);
    }

    /**
     * Update the topic
     *
     * @param  Request  $request
     * @param Int      $id
     * @return Response
     */
    public function update(Request $request, $id) {
        $this->validate($request, [
            'title' => 'required|max:128|min:12',
            'body' => 'required|min:32',
        ], [
            'title.*' => 'หัวข้อต้องมีความยาว 12-128 ตัวอักษร',
            'body.*' => 'เนื้อหาต้องมีความยาวไม่น้อยกว่า 32 ตัวอักษร',
        ]);

        $topic = App\Topic::find($id);

        if (empty($topic)) {
            return view('topic.notFound');
        }

        if (!$topic->canEdit()) {
            return redirect()->action('BoardController@show', ['id' => $topic->id]);
        }

        $topic->title = $request->title;
        $topic->body = clean($request->body);

        $topic->save();

        return redirect()->action('BoardController@show', ['id' => $topic->id]);
    }

    /**
     * Show confirm delete topic page
     *
     * @param  Request  $request
     * @param  Int      $id
     * @return Response
     */
    public function deleteConfirm(Request $request, $id) {
        $topic = App\Topic::find($id);

        if (empty($topic)) {
            return view('topic.notFound');
        }

        if (!$topic->canEdit()) {
            return redirect()->action('BoardController@show', ['id' => $topic->id]);
        }

        return view('topic.delete', ['topic' => $topic]);
    }

    /**
     * Remove topic
     *
     * @param  Request  $request
     * @param  Int      $id
     * @return Response
     */
    public function destroy(Request $request, $id) {
        $topic = App\Topic::find($id);

        if (empty($topic)) {
            return view('topic.notFound');
        }

        if (!$topic->canEdit()) {
            return redirect()->action('BoardController@show', ['id' => $topic->id]);
        }

        $topic->setBan();

        $topic->save();

        return redirect()->action('BoardController@index');
    }

    /**
     * Toggle pin topic
     *
     * @param  Request  $request
     * @param  Int      $id
     * @return Response
     */
    public function pin(Request $request, $id) {
        $topic = App\Topic::find($id);

        if (empty($topic)) {
            return view('topic.notFound');
        }

        if (!$topic->canEdit()) {
            return redirect()->action('BoardController@show', ['id' => $topic->id]);
        }

        $topic->togglePin();

        $topic->save();

        return redirect()->action('BoardController@show', ['id' => $topic->id]);
    }

    /**
     * Toggle lock topic
     *
     * @param  Request  $request
     * @param  Int      $id
     * @return Response
     */
    public function lock(Request $request, $id) {
        $topic = App\Topic::find($id);

        if (empty($topic)) {
            return view('topic.notFound');
        }

        if (!$topic->canEdit()) {
            return redirect()->action('BoardController@show', ['id' => $topic->id]);
        }

        $topic->toggleLock();

        $topic->save();

        return redirect()->action('BoardController@show', ['id' => $topic->id]);
    }
}
?>