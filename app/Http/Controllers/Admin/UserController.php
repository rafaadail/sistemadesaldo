<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UpdateProfileFormRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function profile()
    {
        return view('site.profile.profile');
    }

    public function profileUpdate(UpdateProfileFormRequest $request)
    {

        $user = auth()->user();

        $data = $request->all();

        if ($data['password'] != null) {
           $data['password'] = bcrypt(($data['password']));
        }

        if ($data['password'] == null) {
            unset($data['password']);
        }

        $data['image'] = $user->image;
        if ($request->hasFile('image') && $request->file('image')->isValid()) {

            if( $user->image) {
                $name = $user->image;
            }

            if( !$user->image) {
                $name = $user->id.kebab_case($user->name);
            }

            $extension = $request->image->extension();
            $nameFile = "{$name}.{$extension}";

            $data['image'] = $nameFile;

            $upload = $request->image->storeAs('users', $nameFile);

            if (!$upload) {
                return redirect()
                    ->back()
                    ->with('error', 'Falha ao fazer upload da imagem.');
            }
        }

        $update = $user->update($data);

        if ($update) {
            return redirect()
                ->route('profile')
                ->with('success', 'Sucesso ao atualizar perfil!');
        }

        return redirect()
            ->back()
            ->with('error', 'Falha ao atualizar o perfil...');
    }
}
