<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StokBahanBakuResource\Pages;
use App\Filament\Resources\StokBahanBakuResource\RelationManagers;
use App\Imports\StokBahanBakuImport;
use App\Models\StokBahanBaku;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use App\Models\jenisBahanBaku;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Actions\Action;
use Maatwebsite\Excel\Facades\Excel;
use Filament\Forms\Components\FileUpload;
use Illuminate\Support\Facades\Storage;
use Filament\Notifications\Notification;

class StokBahanBakuResource extends Resource
{
    protected static ?string $model = StokBahanBaku::class;

    protected static ?string $navigationGroup = 'Bahan Baku';
    protected static ?string $navigationIcon = 'heroicon-o-inbox-stack';
    protected static ?string $navigationLabel = 'Stok BB';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('kodeBahanBaku')
                    ->label('Kode Bahan Baku')
                    ->maxLength(10)
                    ->required(),
                Forms\Components\TextInput::make('namaBahanBaku')
                    ->label('Nama Bahan Baku')
                    ->maxLength(100)
                    ->required(),
                Forms\Components\Select::make('jenisBahanBaku')
                    ->label('Jenis Bahan Baku')
                    ->options(jenisBahanBaku::all()->pluck('jenisBahanBaku', 'jenisBahanBaku'))
                    ->searchable(),
                Forms\Components\TextInput::make('jumlahBahanBaku')
                    ->label('Jumlah Bahan Baku')
                    ->numeric()
                    ->required(),
                Forms\Components\TextInput::make('unitBahanBaku')
                    ->label('Unit Bahan Baku')
                    ->maxLength(5)
                    ->required(),
                Forms\Components\TextInput::make('hargaBBperunit')
                    ->label('Harga BB Per Unit')
                    ->numeric()
                    ->required(),
                Forms\Components\TextInput::make('maxLeadTime')
                    ->label('Waktu Rata-Rata yang diperlukan BB Masuk (Hari)')
                    ->numeric()
                    ->required(),
                Forms\Components\TextInput::make('ratarataLeadTime')
                    ->label('Waktu Maksimum yang diperlukan BB Masuk (Hari)')
                    ->numeric()
                    ->required(),
                Forms\Components\TextInput::make('maxBBKeluar')
                    ->label('Maksimum BB Keluar Harian')
                    ->numeric()
                    ->required(),
                Forms\Components\TextInput::make('ratarataPemakaian')
                    ->label('Rata-rata Pemakaian Harian')
                    ->numeric()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kodeBahanBaku')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('namaBahanBaku')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('jumlahBahanBaku')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('unitBahanBaku')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('hargaBBperunit')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('status')->sortable()->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->headerActions([
                Action::make('importExcel')
                    ->label('Import Excel')
                    ->action(function (array $data) {
                        // Pastikan $data['file'] adalah jalur yang valid di storage
                        $filePath = storage_path('app/public/' . $data['file']);

                        // Import file menggunakan jalur absolut
                        Excel::import(new StokBahanBakuImport, $filePath);
                        // Tampilkan notifikasi sukses
                        Notification::make()
                            ->title('Data berhasil diimpor!')
                            ->success()
                            ->send();
                    })
                    ->form([
                        FileUpload::make('file')
                            ->label('Pilih File Excel')
                            ->disk('public') // Pastikan disimpan di disk 'public'
                            ->directory('imports')
                            ->acceptedFileTypes(['application/vnd.openxmlformatsofficedocument.spreadsheetml.sheet', 'application/vnd.ms-excel'])
                            ->required(),
                    ])
                    ->modalHeading('Import Data Stok')
                    ->modalButton('Import')
                    ->color('success'),
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
            'index' => Pages\ListStokBahanBakus::route('/'),
            'create' => Pages\CreateStokBahanBaku::route('/create'),
            'edit' => Pages\EditStokBahanBaku::route('/{record}/edit'),
        ];
    }
}
