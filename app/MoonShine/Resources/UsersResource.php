<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Faker\Guesser\Name;
use Illuminate\Support\Arr;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Text;
use MoonShine\Fields\Image;
use MoonShine\Fields\Phone;
use MoonShine\Fields\Password;
use MoonShine\Fields\PasswordRepeat;
use MoonShine\FormActions\FormAction;

class UsersResource extends ModelResource
{
    protected string $model = User::class;

    protected string $title = 'Users';


    #[SearchUsingFullText(['name', 'username'])]
    public function search(): array
    {
        return ['id', 'name', 'username'];
    }    
    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                Text::make('name'),
                Text::make('username'),
                Text::make('email'),
                Image::make('image'),
                Phone::make('phone'),
                Password::make('Password'),
                PasswordRepeat::make('Password repeat', 'password_repeat') 
                    ->showWhen('id', 100)
                    ->hint('Hint')
                    ->required(),

            ]),
        ];
    
        
    }

    public function rules(Model $item): array
    {
        return [];
    }
}
