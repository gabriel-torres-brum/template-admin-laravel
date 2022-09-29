<?php

namespace App\Http\Livewire\Tenant\People;

use App\Models\Person;
use Carbon\Carbon;
use Livewire\Component;

use Filament\Tables;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class Index extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;

    protected function getTableQuery(): Builder
    {
        $person = Person::query();

        // if ($this->page === 1) {
        //     $person->select(['people.*', 'users.id as user_id'])
        //     ->leftJoin('users', 'people.user_id', '=', 'users.id')
        //     ->orderByRaw("users.id = '" . auth()->id() . "' DESC");
        // }

        return $person->latest();
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('created_at')
                ->date('d/m/Y H:i')
                ->label('Data de inclusão')
                ->sortable()
                ->searchable(),
            Tables\Columns\SpatieMediaLibraryImageColumn::make('people_picture')
                ->label('Foto')
                ->visibility('private')
                ->collection('people_pictures')
                ->rounded(),
            Tables\Columns\TextColumn::make('name')
                ->label('Nome')
                ->sortable()
                ->searchable(),
            Tables\Columns\BadgeColumn::make('gender')
                ->label('Gênero')
                ->sortable()
                ->searchable(),
            Tables\Columns\TextColumn::make('birthday')
                ->label('Data de nascimento')
                ->date('d/m/Y')
                ->description(fn (Person $record) => $record->birthday->age . " anos")
                ->sortable()
                ->searchable(),
            Tables\Columns\TextColumn::make('marital_status')
                ->label('Estado civil')
                ->sortable()
                ->searchable(),
            Tables\Columns\TextColumn::make('created_at')
                ->date('d/m/Y H:i')
                ->label('Data de inclusão')
                ->sortable()
                ->searchable(),
            Tables\Columns\BadgeColumn::make('ecclesiasticalRole.name')
                ->label('Cargo eclesiástico')
                ->sortable()
                ->searchable(),
        ];
    }

    protected function getTableActions(): array
    {
        return [
            Tables\Actions\EditAction::make('editar')
                ->icon('heroicon-o-pencil')
                ->url(fn (Person $record): string => tenantRoute('people.edit', ['person' => $record])),
            Tables\Actions\DeleteAction::make('excluir')
                ->hidden(fn (Person $record) => optional($record->user)->id === auth()->id())
                ->modalHeading('Excluir usuário')
                ->icon('heroicon-o-trash')
                ->action(fn (Person $record) => optional($record->user)->id !== auth()->id() ? $record->delete() : null)
        ];
    }

    protected function getTableBulkActions(): array
    {
        return [
            Tables\Actions\BulkAction::make('excluir')
                ->label('Excluir selecionados')
                ->color('danger')
                ->icon('heroicon-s-trash')
                ->hidden(fn (Person $record) => optional($record->user)->id === auth()->id())
                ->action(function (Collection $records): void {
                    foreach ($records as $record) {
                        if (optional($record->user)->id !== auth()->id()) {
                            $record->delete();
                        }
                    }
                })
                ->requiresConfirmation(),
            ExportBulkAction::make()->exports([
                ExcelExport::make()
                    ->fromTable()
                    ->askForFilename(date('d-m-Y-H-i-s') . '-membros', 'Nome do arquivo')
                    ->askForWriterType('Csv', null, 'Tipo')
            ])->label('Exportar como planilha')->modalButton('Exportar'),
        ];
    }
    public function render(): View
    {
        return view('livewire.tenant.people.index')
            ->layout('tenant.layouts.dashboard-layout');
    }
}
