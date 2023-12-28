<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Main Content')->schema(
                    [
                    TextInput::make('title')->required()
                        // ->afterStateUpdated(function (string $operation, $state, Forms\Set $set) {
                        //     if($operation ==='edit'){
                        //         return;
                        //     }
                        //     $set('slug',Str::slug($state));
                        // })
                        ->minLength(1)
                        ->maxLength(200),
                    TextInput::make('slug')->required()
                        ->minLength(1)
                        ->unique(ignoreRecord: true)
                        ->maxLength(200),
                    RichEditor::make('content')->required()
                        ->fileAttachmentsDirectory('posts/images')
                        ->columnSpanFull(),

                ]
                )->columns(2),
                Section::make('Meta data')->schema(
                    [
                    FileUpload::make('image')->image()->directory('posts/thumbnails'),
                    DateTimePicker::make('publish_at')->nullable(),
                    Checkbox::make('featured'),
                    Select::make('author')
                    ->relationship('author','name')
                    ->searchable()
                    ->required(),
                    Select::make('tags')
                    ->multiple()
                    ->relationship('tags','title')
                    ->searchable(),
                ]
            ),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image'),
                TextColumn::make('title')->sortable()->searchable(),
                TextColumn::make('slug')->sortable()->searchable(),
                TextColumn::make('author.name')->sortable()->searchable(),
                TextColumn::make('publish_at')->date('Y-m-d')
                ->sortable()
                ->searchable(),
                CheckboxColumn::make('featured')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
