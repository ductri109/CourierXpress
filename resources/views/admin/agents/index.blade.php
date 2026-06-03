@extends('admin.layout')

@section('title', 'Agent Management')

@section('content')

    {{-- Handle pagination directly in View --}}
    @php
        use Illuminate\Pagination\LengthAwarePaginator;
        use Illuminate\Pagination\Paginator;

        $perPage = 10;
        $page = Paginator::resolveCurrentPage('page') ?: 1;
        $pageData = $agents->slice(($page - 1) * $perPage, $perPage)->all();

        $agents = new LengthAwarePaginator(
            $pageData,
            $agents->count(),
            $perPage,
            $page,
            [
                'path' => Paginator::resolveCurrentPath(),
                'query' => request()->query()
            ]
        );
    @endphp

    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="d-flex justify-content-between align-items-center mb-6">
            <div>
                <h4 class="mb-1">Agent Management</h4>
                <p class="mb-0 text-muted">Delivery agent list — real data from database.</p>
            </div>
            <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasAddAgent">
                <i class="ri-user-add-line me-1"></i> Add Agent
            </button>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible mb-4" role="alert">
                <i class="ri-check-double-line me-1"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('new_agent'))
            @php $na = session('new_agent'); @endphp
            <div class="alert alert-info alert-dismissible mb-4" role="alert">
                <div class="d-flex align-items-start gap-3">
                    <i class="ri-key-2-line ri-24px mt-1 text-info"></i>
                    <div>
                        <h6 class="mb-1 fw-bold">New Agent Login Credentials</h6>
                        <p class="mb-1 small">Please save and send these to the agent before closing this notification.</p>
                        <div class="d-flex gap-4 mt-2 flex-wrap">
                            <div>
                                <span class="text-muted small">Username</span><br>
                                <code class="fs-6 text-dark fw-bold">{{ $na['username'] }}</code>
                            </div>
                            <div>
                                <span class="text-muted small">Password</span><br>
                                <code class="fs-6 text-dark fw-bold">{{ $na['password'] }}</code>
                            </div>
                            <div>
                                <span class="text-muted small">Login Link</span><br>
                                <a href="{{ route('agent.login') }}" target="_blank" class="small">{{ route('agent.login') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible mb-4" role="alert">
                <i class="ri-alert-line me-1"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- ===== KPI CARDS ===== --}}
        <div class="row g-6 mb-6">
            <div class="col-sm-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <p class="text-heading mb-1">Total Agents</p>
                                <div class="d-flex align-items-center">
                                    <h4 class="mb-1 me-2">{{ $totalAgents }}</h4>
                                </div>
                                <small class="text-muted">Registered</small>
                            </div>
                            <div class="avatar">
                                <div class="avatar-initial bg-label-primary rounded">
                                    <i class="ri-shield-user-line ri-26px"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <p class="text-heading mb-1">Available</p>
                                <div class="d-flex align-items-center">
                                    <h4 class="mb-1 me-2">{{ $activeAgents }}</h4>
                                    <p class="text-success mb-1 small">Ready to work</p>
                                </div>
                                <small class="text-muted">Status: active</small>
                            </div>
                            <div class="avatar">
                                <div class="avatar-initial bg-label-success rounded">
                                    <i class="ri-user-follow-line ri-26px"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <p class="text-heading mb-1">Busy</p>
                                <div class="d-flex align-items-center">
                                    <h4 class="mb-1 me-2">{{ $busyAgents }}</h4>
                                    <p class="text-warning mb-1 small">Currently delivering</p>
                                </div>
                                <small class="text-muted">Status: busy</small>
                            </div>
                            <div class="avatar">
                                <div class="avatar-initial bg-label-warning rounded">
                                    <i class="ri-truck-line ri-26px"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <p class="text-heading mb-1">Total Delivered</p>
                                <div class="d-flex align-items-center">
                                    <h4 class="mb-1 me-2">{{ $totalDelivered }}</h4>
                                </div>
                                <small class="text-muted">Across all agents</small>
                            </div>
                            <div class="avatar">
                                <div class="avatar-initial bg-label-info rounded">
                                    <i class="ri-checkbox-circle-line ri-26px"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ===== TABLE ===== --}}
        <div class="card">
            <div class="card-header border-bottom d-flex justify-content-between align-items-center gap-3 flex-wrap">
                <div>
                    <h5 class="card-title mb-1">Agent List</h5>
                    <small class="text-muted">Total: {{ method_exists($agents, 'total') ? $agents->total() : $agents->count() }} agent(s)</small>
                </div>
                <form method="GET" action="{{ route('admin.agents.index') }}" class="d-flex gap-2">
                    <input type="text" name="search" class="form-control" placeholder="Search name, email, phone..." value="{{ request('search') }}" style="min-width:220px">
                    <select name="status" class="form-select" style="min-width:130px">
                        <option value="">All</option>
                        <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
                        <option value="busy" {{ request('status') === 'busy' ? 'selected' : '' }}>Busy</option>
                        <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    <button class="btn btn-outline-primary" type="submit"><i class="ri-search-line"></i></button>
                    @if(request()->hasAny(['search', 'status']))
                        <a href="{{ route('admin.agents.index') }}" class="btn btn-outline-secondary">Reset</a>
                    @endif
                </form>
            </div>

            <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Agent</th>
                        <th>Contact</th>
                        <th>Username</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Total Orders</th>
                        <th class="text-center">Delivered</th>
                        <th class="text-center">In Transit</th>
                        <th class="text-end">Actions</th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    @forelse($agents as $agent)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="avatar">
                                        <div class="avatar-initial rounded-circle bg-label-primary">
                                            {{ strtoupper(substr($agent->FullName, 0, 1)) }}
                                        </div>
                                    </div>
                                    <div>
                                        <h6 class="mb-0">{{ $agent->FullName }}</h6>
                                        <small class="text-muted">ID #{{ str_pad($agent->ID, 4, '0', STR_PAD_LEFT) }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div>{{ $agent->Email }}</div>
                                <small class="text-muted">{{ $agent->Phone }}</small>
                            </td>
                            <td>
                                <code class="text-body">{{ $agent->Username }}</code>
                            </td>
                            <td class="text-center">
                                @php $st = strtolower($agent->Status); @endphp
                                @if($st === 'active')
                                    <span class="badge bg-label-success rounded-pill">Active</span>
                                @elseif($st === 'busy')
                                    <span class="badge bg-label-warning rounded-pill">Busy</span>
                                @elseif($st === 'inactive')
                                    <span class="badge bg-label-danger rounded-pill">Inactive</span>
                                @else
                                    <span class="badge bg-label-secondary rounded-pill">{{ $agent->Status }}</span>
                                @endif
                            </td>
                            <td class="text-center fw-semibold">{{ $agent->total_orders ?? 0 }}</td>
                            <td class="text-center text-success fw-semibold">{{ $agent->delivered_orders ?? 0 }}</td>
                            <td class="text-center text-primary fw-semibold">{{ $agent->active_orders ?? 0 }}</td>
                            <td class="text-end">
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="ri-more-2-line"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="{{ route('admin.agents.show', $agent->ID) }}">
                                            <i class="ri-eye-line me-2"></i> View Details
                                        </a>
                                        <button class="dropdown-item" type="button"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editAgent{{ $agent->ID }}">
                                            <i class="ri-pencil-line me-2"></i> Edit
                                        </button>

                                        {{-- Quick status change --}}
                                        @if($st !== 'active')
                                            <form action="{{ route('admin.agents.status', $agent->ID) }}" method="POST">
                                                @csrf @method('PATCH')
                                                <input type="hidden" name="status" value="active">
                                                <button type="submit" class="dropdown-item text-success">
                                                    <i class="ri-user-follow-line me-2"></i> Set to Active
                                                </button>
                                            </form>
                                        @endif
                                        @if($st !== 'busy')
                                            <form action="{{ route('admin.agents.status', $agent->ID) }}" method="POST">
                                                @csrf @method('PATCH')
                                                <input type="hidden" name="status" value="busy">
                                                <button type="submit" class="dropdown-item text-warning">
                                                    <i class="ri-truck-line me-2"></i> Set to Busy
                                                </button>
                                            </form>
                                        @endif
                                        @if($st !== 'inactive')
                                            <form action="{{ route('admin.agents.status', $agent->ID) }}" method="POST">
                                                @csrf @method('PATCH')
                                                <input type="hidden" name="status" value="inactive">
                                                <button type="submit" class="dropdown-item text-danger">
                                                    <i class="ri-forbid-line me-2"></i> Set to Inactive
                                                </button>
                                            </form>
                                        @endif

                                        <div class="dropdown-divider"></div>
                                        <form action="{{ route('admin.agents.destroy', $agent->ID) }}" method="POST"
                                              onsubmit="return confirm('Delete agent {{ $agent->FullName }}? This action cannot be undone!')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="dropdown-item text-danger">
                                                <i class="ri-delete-bin-6-line me-2"></i> Delete agent
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        {{-- Edit Modal --}}
                        <div class="modal fade" id="editAgent{{ $agent->ID }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <form action="{{ route('admin.agents.update', $agent->ID) }}" method="POST">
                                        @csrf @method('PUT')
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Agent — {{ $agent->FullName }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-floating form-floating-outline mb-4">
                                                <input type="text" name="FullName" class="form-control" value="{{ $agent->FullName }}" placeholder="Full Name" required>
                                                <label>Full Name</label>
                                            </div>
                                            <div class="form-floating form-floating-outline mb-4">
                                                <input type="email" name="Email" class="form-control" value="{{ $agent->Email }}" placeholder="Email" required>
                                                <label>Email</label>
                                            </div>
                                            <div class="form-floating form-floating-outline mb-4">
                                                <input type="text" name="Phone" class="form-control" value="{{ $agent->Phone }}" placeholder="Phone Number" required>
                                                <label>Phone Number</label>
                                            </div>
                                            <div class="form-floating form-floating-outline mb-4">
                                                <select name="Status" class="form-select">
                                                    <option value="active" {{ strtolower($agent->Status) === 'active' ? 'selected' : '' }}>Active</option>
                                                    <option value="busy" {{ strtolower($agent->Status) === 'busy' ? 'selected' : '' }}>Busy</option>
                                                    <option value="inactive" {{ strtolower($agent->Status) === 'inactive' ? 'selected' : '' }}>Inactive</option>
                                                </select>
                                                <label>Status</label>
                                            </div>
                                            <div class="form-floating form-floating-outline">
                                                <input type="password" name="new_password" class="form-control" placeholder="Leave blank to keep current">
                                                <label>New Password (leave blank to keep current)</label>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-6">
                                <i class="ri-shield-user-line ri-48px d-block mb-2 text-muted opacity-50"></i>
                                No agents found. <a href="javascript:void(0)" data-bs-toggle="offcanvas" data-bs-target="#offcanvasAddAgent">Add one now</a>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if(method_exists($agents, 'hasPages') && $agents->hasPages())
                <div class="card-footer border-top px-4 py-3">
                    {{ $agents->appends(request()->query())->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </div>

    </div>

    {{-- ===== ADD AGENT OFFCANVAS ===== --}}
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddAgent" aria-labelledby="offcanvasAddAgentLabel">
        <div class="offcanvas-header border-bottom">
            <h5 id="offcanvasAddAgentLabel" class="offcanvas-title">Add New Agent</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body mx-0 flex-grow-0">
            <form action="{{ route('admin.agents.store') }}" method="POST">
                @csrf
                <div class="form-floating form-floating-outline mb-5">
                    <input type="text" class="form-control" name="FullName" placeholder="Nguyen Van A" required>
                    <label>Full Name *</label>
                </div>
                <div class="form-floating form-floating-outline mb-5">
                    <input type="email" class="form-control" name="Email" placeholder="agent@example.com" required>
                    <label>Email *</label>
                </div>
                <div class="form-floating form-floating-outline mb-5">
                    <input type="text" class="form-control" name="Phone" placeholder="0981 234 567" required>
                    <label>Phone Number *</label>
                </div>
                <div class="form-floating form-floating-outline mb-5">
                    <input type="text" class="form-control" name="Username" placeholder="agent_username" required>
                    <label>Username *</label>
                </div>
                <div class="form-floating form-floating-outline mb-5">
                    <input type="password" class="form-control" name="password" placeholder="Password" required minlength="6">
                    <label>Password (min 6 characters) *</label>
                </div>
                <div class="form-floating form-floating-outline mb-5">
                    <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required>
                    <label>Confirm Password *</label>
                </div>
                <button type="submit" class="btn btn-primary me-3">Save Agent</button>
                <button type="reset" class="btn btn-outline-danger" data-bs-dismiss="offcanvas">Cancel</button>
            </form>
        </div>
    </div>

@endsection
