<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ValidateUrl
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        $url = $request->route('url');
        if (!is_null($url) && !filter_var($url, FILTER_VALIDATE_URL)) {
            return redirect('/')->with('error', 'La URL no es válida');
        }

        if ($request->has('img_url')) {
            $img_url = $request->input('img_url');

            if (!filter_var($img_url, FILTER_VALIDATE_URL)) {
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['img_url' => 'La URL de la imagen no es válida']);
            }

            $extension = strtolower(pathinfo($img_url, PATHINFO_EXTENSION));
            if (!in_array($extension, ['png', 'jpg', 'jpeg'])) {
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['img_url' => 'La URL de la imagen debe terminar en .png, .jpg o .jpeg']);
            }
        }

        return $next($request);
    }
}