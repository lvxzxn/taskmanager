@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Detalhes da Tarefa') }}</div>

                <div class="card-body">
                    <p><strong>{{ __('Nome') }}:</strong> {{ $task->title }}</p>
                    <p><strong>{{ __('Descrição') }}:</strong> {{ $task->description }}</p>
                    <p><strong>{{ __('ID') }}:</strong> {{ $task->id }}</p>
                    <p><strong>{{ __('Criada em') }}:</strong> {{ $task->created_at }}</p>
                    <p><strong>{{ __('Atualizada em') }}:</strong> {{ $task->updated_at }}</p>         
                    @php
                        $badgeColor = '';
                        switch ($task->status) {
                            case 'pendente':
                                $badgeColor = 'warning';
                                break;
                            case 'concluída':
                                $badgeColor = 'success';
                                break;
                            case 'cancelada':
                                $badgeColor = 'danger';
                                break;
                            default:
                                $badgeColor = 'secondary';
                        }
                    @endphp
                    <p>
                        <strong>{{ __('Status') }}:</strong>
                        <span class="badge bg-{{ $badgeColor }}">{{ ucfirst($task->status) }}</span>
                    </p>
                    <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-primary">{{ __('Editar') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection