@extends('layouts.app')

@section('content')
    <div class="wrapper mx-5 mt-5">
        <h1>Historique des actions administratives</h1>
        <ul class="timeline">
            @foreach ($auditLogs as $log)
                <li>
                    <div class="timeline-badge">
                        <i class="fa fa-info"></i>
                    </div>
                    <div class="timeline-panel">
                        <div class="timeline-heading">
                            <h4 class="timeline-title">
                                {{ $log->created_at->format('d-m-Y H:i') }}
                            </h4>
                        </div>
                        <div class="timeline-body">
                            <p>
                                @if ($log->admin)
                                    Admin “{{ $log->admin->name }}” {{ $log->action }}
                                    @if ($log->employee)
                                        l'employé “{{ $log->employee->name }}” à rejoindre la société
                                    @endif
                                    {{ $log->societe ? '“' . $log->societe->nom . '”' : '' }}
                                @endif
                            </p>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
