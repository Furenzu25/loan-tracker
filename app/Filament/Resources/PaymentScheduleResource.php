<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PaymentScheduleResource\Pages;
use App\Filament\Resources\PaymentScheduleResource\RelationManagers;
use App\Models\PaymentSchedule;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PaymentScheduleResource extends Resource
{
    protected static ?string $model = PaymentSchedule::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\BelongsToSelect::make('loan_id')
                ->relationship('loan','id')->required(),
            Forms\Components\DatePicker::make('due_date')->required(),
            Forms\Components\TextInput::make('amount_due')->numeric()->required(),
            Forms\Components\Toggle::make('paid'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('loan.customer.name')->label('Customer'),
            Tables\Columns\TextColumn::make('due_date')->date(),
            Tables\Columns\TextColumn::make('amount_due')->money('USD'),
            Tables\Columns\BadgeColumn::make('paid')
                ->enum([0=>'Pending',1=>'Paid'])
                ->colors(['danger'=>'0','success'=>'1'])
                ->label('Status'),
            Tables\Columns\TextColumn::make('payment_id')->label('Payment ID'),
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
            'index' => Pages\ListPaymentSchedules::route('/'),
            'create' => Pages\CreatePaymentSchedule::route('/create'),
            'edit' => Pages\EditPaymentSchedule::route('/{record}/edit'),
        ];
    }
}
