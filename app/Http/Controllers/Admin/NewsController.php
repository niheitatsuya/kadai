<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\News;
use App\History;
use Carbon\Carbon;
use Storage;

class NewsController extends Controller
{
    
    public function add()
    {
        return view("admin.news.create");
    }
  public function create(Request $request)
  {

    $this->validate($request, News::$rules);
    $news = new News;
    $form = $request->all();
    if (isset($form['image'])) {
        $path = Storage::disk('s3')->putFile('/',$news_form['image'],'public');
        $news->image_path = Storage::disk('s3')->url($path);
      } else {
          $news->image_path = null;
      }
      unset($form['_token']);
      unset($form['image']);
      
      $news->fill($form);
      $news->save();
      
      return redirect('admin/news/create');
      
      }
      
      public function index(Request $request)
      {
          $cond_title = $request->cond_title;
          
          if ($cond_title != '') {
              $posts = News::where('title', $cond_title)->get();
              } else {
                  $posts = News::all();
              }
              return view('admin.news.index', ['posts' => $posts, 'cond_title' => $cond_title]);
      }
      
      public function edit(Request $request)
      {
          $news = News::find($request->id);
          if (empty($news)) {
              abort(404);
          }
          return view('admin.news.edit', ['news_form' => $news]);
      }
      
      public function update(Request $request)
      {
          $this->validate($request, News::$rules);
          $news = News::find($request->id);
          $news_form = $request->all();
          if ($request->remove == 'true') {
          $news_form['image_path'] = null;
      } elseif ($request->file('image')) {
          $path = Storage::disk('s3')->putFile('/',$news_form['image'],'public');
          $news->image_path = Storage::disk('s3')->url($path);
      } else {
          $news_form['image_path'] = $news->image_path;
      }

          unset($news_form['image']);
          unset($news_form['remove']);
          unset($news_form['_token']);
          $news->fill($news_form)->save();
          $history = new History();
          $history->news_id = $news->id;
          $history->edited_at = Carbon::now();
          $history->save();
          return redirect('admin/news');
      }
      
      public function delete(Request $request)
      {
          $news = News::find($request->id);
          $request->delete();
          return redirect('admin/news/');
      }
      
}
