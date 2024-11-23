<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PemakaianBahanBakuResource\Pages;
use App\Filament\Resources\PemakaianBahanBakuResource\RelationManagers;
use App\Imports\PemakaianBahanBakuImport;
use App\Models\PemakaianBahanBaku;
use App\Models\produksi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\stokBahanBaku;
use Filament\Tables\Actions\Action;
use Maatwebsite\Excel\Facades\Excel;
use Filament\Forms\Components\FileUpload;
use Illuminate\Support\Facades\Storage;
use Filament\Notifications\Notification;

class PemakaianBahanBakuResource extends Resource
{
    protected static ?string $model = PemakaianBahanBaku::class;

    protected static ?string $navigationIcon = 'heroicon-o-bookmark-square';
    protected static ?string $navigationGroup = 'Produksi';
    protected static ?string $navigationLabel = 'Pemakaian BB';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DatePicker::make('tanggalPemakaian')
                    ->label('Tanggal Pemakaian')
                    ->required(),

                Forms\Components\Select::make('kodeBahanBaku')
                    ->label('Kode Bahan Baku')
                    ->options(stokBahanBaku::all()->mapWithKeys(function ($item) {
                        return [$item->kodeBahanBaku => $item->kodeBahanBaku . ' - ' . $item->namaBahanBaku];
                    })
                        ->prepend('-', '-'))
                    ->required()
                    ->searchable(),

                Forms\Components\Select::make('kodeProduksi')
                    ->label('Kode Produksi')
                    ->options(produksi::all()->mapWithKeys(function ($item) {
                        return [$item->kodeProduksi => $item->kodeProduksi . ' - ' . $item->namaBarang];
                    }))
                    ->required()
                    ->searchable(),

                Forms\Components\TextInput::make('jumlahPemakaian')
                    ->label('Jumlah Pemakaian')
                    ->maxLength(20)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('tanggalPemakaian')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('kodeBahanBaku')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('kodeProduksi')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('jumlahPemakaian')->sortable()->searchable(),
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
                        Excel::import(new PemakaianBahanBakuImport, $filePath);
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
                    ->modalHeading('Import Data Pegawai')
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
            'index' => Pages\ListPemakaianBahanBakus::route('/'),
            'create' => Pages\CreatePemakaianBahanBaku::route('/create'),
            'edit' => Pages\EditPemakaianBahanBaku::route('/{record}/edit'),
        ];
    }
}
