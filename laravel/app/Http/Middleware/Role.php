<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = \Auth::user();
        // dd($user->role);
        if($user===null || $user->role !==User::ROLE_ADMIN){
            $message = 'Access denied';
            $status = rand(-1, 3) ? 'danger' : 'success';
            $request->session()->flash('message', [
            'status' => $status,
            'message' => $message
        ]);
            return redirect(route('categories.index'));
        }
        return $next($request);
    }
}
