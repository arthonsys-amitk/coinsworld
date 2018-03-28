<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slider;

class SliderController extends Controller
{
    public function index()
    {
         $sliders = Slider::orderBy('position', 'asc')->get();
         $slide = Slider::first();
         return view('admin.interface.slider', compact('slide', 'sliders'));
    }

	public function delete(Request $request)
    {
		$slider = Slider::find($request->id);
		if($slider->id == $request->id) {
			$slider->delete();
			return back()->with('success', 'Banner Deleted Successfully!');
		} else {
			return back()->with('alert', 'Banner Could Not Be Deleted!');
		}
	}
	
	public function add(Request $request)
    {
		$this->validate($request,
		[
			'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:8048',
			'position' => 'required|integer',
		]);
		
		$image = '';
		if($request->hasFile('image'))
        {
            $image = uniqid() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move('assets/images/slider',$image);
        }

        $ret = Slider::create([
                    'image' => $image,
                    'bold' => $request->bold,
                    'small' => $request->small,
					'position' => $request->position,
					'link' => $request->link
            ]);

        return back()->with('success', 'Banner Added Successfully!');
	}
	
    public function update(Request $request)
    {
        $slide = Slider::first();
        $this->validate($request,
            [
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:8048',
            ]);

       if($request->hasFile('image'))
        {
             $path = 'assets/images/slider/'. $slide->image;

                if(file_exists($path))
                {
                    unlink($path);
                }
                
            $slide['image'] = uniqid().'.'.$request->image->getClientOriginalExtension();
            $request->image->move('assets/images/slider',$slide['image']);
        }

        $slide['bold'] = $request->bold;
        $slide['small'] = $request->small;
        $slide->save();

        return back()->with('success', 'Banner Updated Successfully!');
    }

}
