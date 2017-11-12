<?php

namespace App\Http\Controllers;
use App\Http\Requests\NewTopicRequest;
use App\Repositories\TopicRepository;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TopicController extends Controller
{
    protected $topicRepository;


    /**
     * TopicController constructor
     * @param $topicRepository
     */
    public function __construct(TopicRepository $topicRepository) {
        $this->topicRepository = $topicRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('topics.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('topics.new_topic');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewTopicRequest $request)
    {

        $data = [
            'user_id' => Auth::id(),
            'title' => $request->get('title'),
            'body' => $request->get('body')
        ];
        $topic = $this->topicRepository->create($data);
        $topic->user()->increment('num_topics');

        return redirect()->route('show_topic', ['id' => $topic->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $topic = $this->topicRepository->findByIdWithComments($id);
        return view('topics.topic', compact('topic'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $topic = $this->topicRepository->findById($id);

        if(Auth::user()->owns($topic)){
            return view('topics.edit_topic', compact('topic'));
        }else{
            return back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NewTopicRequest $request, $id)
    {
        $topic = $this->topicRepository->findById($id);

        $topic->update([
            'title' => $request->get('title'),
            'body' => $request->get('body'),
        ]);

        return redirect()->route('show_topic', ['id' => $topic->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $topic = $this->topicRepository->findById($id);
        if(Auth::user()->owns($topic)){
            $topic->delete();
        }

        return redirect()->route('index_topic');
    }

    public function search(Request $request) {
        $owner_id = $request->get('owner_id');
        if($owner_id) {
            return $this->topicRepository->findByOwner($owner_id);
        }

        $follower_id = $request->get('follower_id');
        if($follower_id) {
            return $this->topicRepository->findByFollower($follower_id);
        }

        $follower_id = $request->get('keyword');
        if($follower_id) {
            return $this->topicRepository->findByKeyword($follower_id);
        }

        return $this->topicRepository->getTopicsFeed();
    }
}
