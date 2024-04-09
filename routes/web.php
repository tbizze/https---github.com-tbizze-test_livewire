<?php

use App\Livewire\Admin\PermissionIndex;
use App\Livewire\Admin\RoleHasPermissionEdit;
use App\Livewire\Admin\RoleIndex;
use App\Livewire\Admin\UserToRoleIndex;
use App\Livewire\CategoryIndex;
use App\Livewire\Counter;
use App\Livewire\DashboardIndex;
use App\Livewire\Event\EventoAreaIndex;
use App\Livewire\Event\EventoGrupoIndex;
use App\Livewire\Event\EventoLocalIndex;
use App\Livewire\Finance\FaturaEmissoraIndex;
use App\Livewire\Finance\FaturaGrupoIndex;
use App\Livewire\Finance\FaturaIndex;
use App\Livewire\Finance\MovimentoGrupoIndex;
use App\Livewire\Finance\MovimentoIndex;
use App\Livewire\Finance\PgtoTipoIndex;
use App\Livewire\Finance\StatusIndex;
use App\Livewire\PostIndex;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    /* Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard'); */

    Route::get('/dashboard', DashboardIndex::class)->name('dashboard');

    Route::get('/posts', PostIndex::class)->name('posts');
    Route::get('/categories', CategoryIndex::class)->name('categories');

    Route::get('/fatura/emissoras', FaturaEmissoraIndex::class)->name('fatura.emissoras.index')->middleware('permission:fatura.emissoras.index');
    Route::get('/fatura/grupos', FaturaGrupoIndex::class)->name('fatura.grupos.index')->middleware('permission:fatura.grupos.index');
    Route::get('/movimento/grupos', MovimentoGrupoIndex::class)->name('movimento.grupos.index')->middleware('permission:movimento.grupos.index');

    Route::get('/admin/status', StatusIndex::class)->name('admin.status.index')->middleware('permission:admin.status.index');
    Route::get('/admin/pgto_tipos', PgtoTipoIndex::class)->name('admin.pgto_tipos.index')->middleware('permission:admin.pgto_tipos.index');
    
    Route::get('/movimentos', MovimentoIndex::class)->name('movimentos.index')->middleware('permission:movimentos.index');
    Route::get('/faturas', FaturaIndex::class)->name('faturas.index')->middleware('permission:faturas.index');

    Route::get('/evento/grupos', EventoGrupoIndex::class)->name('evento.grupos');
    Route::get('/evento/areas', EventoAreaIndex::class)->name('evento.areas');
    Route::get('/evento/locals', EventoLocalIndex::class)->name('evento.locals');
    
    Route::group(['middleware' => ['role:Admin']], function () { 
        Route::get('/admin/roles', RoleIndex::class)->name('admin.roles');
        Route::get('/admin/permissions', PermissionIndex::class)->name('admin.permissions');
        Route::get('/admin/user-to-roles', UserToRoleIndex::class)->name('admin.user-to-roles');
        Route::get('/admin/role-has-permissions/{role}/edit', RoleHasPermissionEdit::class)->name('admin.role-has-permissions');
    });
    /* Route::group(['prefix' => 'admin', 'middleware' => ['role:Admin']], function() {

        
     }); */

    
    /* Route::get('/admin/role-has-permissions/{role}/edit', RoleHasPermissionEdit::class,
    ['middleware' => 'can:editPost,post'])->name('admin.role-has-permissions'); */
});