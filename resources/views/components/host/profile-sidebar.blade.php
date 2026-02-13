<div class="card">
    <div class="card-body">
        <div class="d-flex gap-3">
            @if (!empty($project->host->avatar))
                <div class="avatar">
                    <img src="{{ asset('storage/' . $project->host->avatar) }}"
                            alt="Foto de {{ $project->host->name }}"
                            class="img-fluid object-fit-contain rounded-circle"
                            width="80"
                            height="80">
                </div>
            @endif
            <div class="flex-fill">
                <div class="d-flex justify-content-between align-items-center">
                    <h2 class="small text-muted">Anfitrión</h2>
                </div>
                <h3 class="card-title h4">{{ $project->host->name }}</h3>
                <ul class="list-unstyled mb-3">
                    <li>{{ $project->host->location->province->name ?? 'Sin ubicación' }}</li>
                    <li><span class="text-muted small">En la comunidad desde</span>
                        {{ $project->created_at->format('Y') }}</li>
                </ul>

                @if (Auth::check() && Auth::user()->hasRole('volunteer'))
                    @if ($isInHostRoster)
                        <div class="social-media d-flex gap-3">
                            @if ($project->host->linkedin)
                                <a href="{{ $project->host->linkedin }}"
                                    target="_blank"
                                    class="fs-5"><i class="bi bi-linkedin"></i></a>
                            @endif

                            @if ($project->host->instagram)
                                <a href="{{ $project->host->instagram }}"
                                    target="_blank"
                                    class="fs-5"><i class="bi bi-instagram"></i></a>
                            @endif

                            @if ($project->host->facebook)
                                <a href="{{ $project->host->facebook }}"
                                    target="_blank"
                                    class="fs-5"><i class="bi bi-facebook"></i></a>
                            @endif
                        </div>
                        <hr />
                    @endif

                    @if ($isAceptedByHost)
                        <ul class="list-unstyled">
                            <li>Contacto: {{ $project->host->person_full_name }}</li>
                            <li>Teléfono: {{ $project->host->phone }}</li>
                            <li>Email: <a href="mailto:{{ $project->host->user->email }}"
                                    target="_blank">{{ $project->host->user->email }}</a></li>
                        </ul>
                    @endif

                    @if ($isInHostRoster)
                    <a href="{{ route('volunteer.hosts.profile', $project->host->id) }}"
                            class="btn-azul btn-sm btn">Ver perfil</a>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>
