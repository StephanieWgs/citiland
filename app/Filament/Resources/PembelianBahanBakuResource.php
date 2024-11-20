<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PembelianBahanBakuResource\Pages;
use App\Filament\Resources\PembelianBahanBakuResource\RelationManagers;
use App\Imports\PembelianBahanBakuImport;
use App\Models\PembelianBahanBaku;
use App\Models\stokBahanBaku;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use App\Models\supplier;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Actions\Action;
use Maatwebsite\Excel\Facades\Excel;
use Filament\Forms\Components\FileUpload;
use Illuminate\Support\Facades\Storage;
use Filament\Notifications\Notification;

class PembelianBahanBakuResource extends Resource
{
    protected static ?string $model = PembelianBahanBaku::class;

    protected static ?string $navigationGroup = 'Pembelian';
    protected static ?string $navigationIcon = 'heroicon-o-document-currency-dollar';
    protected static ?string $navigationLabel = 'Pembelian Bahan Baku';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('kodeBahanBaku')
                    ->label('Kode Bahan Baku')
                    ->options(stokBahanBaku::all()->mapWithKeys(function ($item) {
                        return [$item->kodeBahanBaku => $item->kodeBahanBaku . ' - ' . $item->namaBahanBaku];
                    }))
                    ->searchable(),

                Forms\Components\TextInput::make('namaBahanBaku')
                    ->label('Nama Bahan Baku')
                    ->required()
                    ->maxLength(100),

                Forms\Components\TextInput::make('jumlahPembelian')
                    ->label('Jumlah pembelian')
                    ->required()
                    ->numeric()
                    ->maxLength(20),

                Forms\Components\TextInput::make('unitBB')
                    ->label('Unit Barang Baku')
                    ->required()
                    ->maxLength(5),

                Forms\Components\Select::make('namaSupplier')
                    ->label('Nama Supplier')
                    ->options(supplier::all()->mapWithKeys(function ($item) {
                        return [$item->namasupplier => $item->kodesupplier . ' - ' . $item->namasupplier];
                    }))
                    ->searchable(),

                Forms\Components\TextInput::make('hargaBB')
                    ->label('Harga Barang Baku')
                    ->required()
                    ->numeric()
                    ->maxLength(25),

                Forms\Components\DatePicker::make('tanggalPembelian')
                    ->label('Tanggal Pembelian')
                    ->required(),

                Forms\Components\TextInput::make('jenisBahanBaku')
                    ->label('Jenis Bahan Baku')
                    ->required()
                    ->maxLength(5),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('kodeBahanBaku')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('namaBahanBaku')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('tanggalPembelian')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('namaSupplier')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('jenisBahanBaku')->sortable()->searchable(),
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
                        Excel::import(new PembelianBahanBakuImport, $filePath);
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
            'index' => Pages\ListPembelianBahanBakus::route('/'),
            'create' => Pages\CreatePembelianBahanBaku::route('/create'),
            'edit' => Pages\EditPembelianBahanBaku::route('/{record}/edit'),
        ];
    }
}
