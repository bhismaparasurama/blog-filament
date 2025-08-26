<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlogResource\Pages;
use App\Models\Blog;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;

class BlogResource extends Resource
{
    protected static ?string $model = Blog::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Blogs';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('title')
                ->required(),
            Forms\Components\FileUpload::make('image')
                ->image()
                ->directory('blogs'),
            Forms\Components\RichEditor::make('content')
                ->label('Content')
                ->toolbarButtons([
                    'bold',
                    'italic',
                    'underline',
                    'strike',
                    'link',
                    'bulletList',
                    'orderedList',
                    'blockquote',
                    'h2',
                    'h3',
                    'codeBlock',
                ])
                ->columnSpanFull()
                ->required(),
            Forms\Components\Select::make('category_id')
                ->relationship('category', 'name')
                ->required(),
        ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('id'),
            Tables\Columns\ImageColumn::make('image')->circular(),
            Tables\Columns\TextColumn::make('title')->searchable(),
            Tables\Columns\TextColumn::make('category.name')->label('Category'),
            Tables\Columns\TextColumn::make('created_at')->dateTime(),
        ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->relationship('category', 'name')
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(), // <-- otomatis ada tombol hapus
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(), // hapus banyak sekaligus
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBlogs::route('/'),
            'create' => Pages\CreateBlog::route('/create'),
            'edit' => Pages\EditBlog::route('/{record}/edit'),
        ];
    }
}
