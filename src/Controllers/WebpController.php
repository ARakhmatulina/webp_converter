<?php

namespace Mechta\WebpConverter\Controllers;

use Mechta\WebpConverter\Services\WebpConverter;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class WebpController extends Controller
{
    private function getConverter()
    {
        return app(WebpConverter::class);
    }

    public function show()
    {
        return view('webp::convert_form');
    }

    public function convert(Request $request): RedirectResponse
    {
        if (! $request->hasFile('image')) {
            return redirect()->back()->with('error', 'Image is empty!');
        }

        $file = $request->file('image');
        $file->storeAs('public/webp', $file->getClientOriginalName());

        $converter = $this->getConverter();
        $result = $converter->convert($file->getClientOriginalName(), 'webp');

        if (! $result) {
            return redirect()->back()->with('error', 'Convert image error');
        }

        return redirect()->back()->with('newPath', $converter->getPath());
    }
}