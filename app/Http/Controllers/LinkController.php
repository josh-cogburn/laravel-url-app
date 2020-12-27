<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
// use App\Repositories\TaskRepository;

class LinkController extends Controller
{
    //
    /**
     * The link repository instance.
     *
     * @var LinkRepository
     */
    protected $links;    

    /**
     * Paginate the authenticated user's links.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // paginate the authorized user's links with 5 per page
        $links = Auth::user()
            ->links()
            ->orderBy('label')
            ->orderBy('id')
            ->paginate(5);

        // return link index view with paginated tasks
        return view('links', [
            'links' => $links
        ]);
    }

    /**
     * Store a new link for the authenticated user.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // validate the given request
        $data = $this->validate($request, [
            'label' => 'required|string|max:255',
            'url' => 'required|string|max:255',
        ]);

        // create a new link with the given label and url
        Auth::user()->links()->create([
            'label' => $data['label'],
            'url' => $data['url'],
        ]);

        // flash a success message to the session
        session()->flash('status', 'Link Created!');

        // redirect to tasks index
        return redirect('/links');
    }        

    // /**
    //  * Mark the given task as complete and redirect to tasks index.
    //  *
    //  * @param \App\Models\Task $task
    //  * @return \Illuminate\Routing\Redirector
    //  * @throws \Illuminate\Auth\Access\AuthorizationException
    //  */
    // public function update(Link $link)
    // {
    //     // check if the authenticated user can complete the task
    //     $this->authorize('complete', $link);

    //     // mark the task as complete and save it
    //     $task->is_complete = true;
    //     $task->save();

    //     // flash a success message to the session
    //     session()->flash('status', 'Task Completed!');

    //     // redirect to tasks index
    //     return redirect('/tasks');
    // }

    /**
     * Destroy the given link.
     *
     * @param  Request  $request
     * @param  Link  $link
     * @return Response
     */
    // public function destroy(Request $request, Task $task)
    public function destroy(Link $link)
    {
        $this->authorize('destroy', $link);

        // Delete The Task...
        $link->delete();

        return redirect('/links');        
    }


}
