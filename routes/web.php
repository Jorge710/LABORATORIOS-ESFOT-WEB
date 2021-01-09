<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', 'InicioController@index')->name('inicio');

Route::get('maskAsRead', function(){
    auth()->user()->unreadNotifications->markAsRead();
    return redirect()->back();
})->name('markRead');

Auth::routes(['verify' => true]);


/**Rutas */
Route::middleware(['auth'])->middleware('verified')->group(function(){
    /**laravel 5 'permission:roles.edit'; laravel 6 'can:roles.edit'*/

    /**Ruta actualizar la página de inicio*/
    Route::get('editar-pagina-inicio/editar-pagina', 'InicioController@editarPagina')->name('inicio.editarPagina')
        ->middleware('can:page.index');
    Route::put('editar-pagina-inicio/{id}', 'InicioController@update')->name('editar-pagina-inicio.update')
        ->middleware('can:page.edit');
    
    /** Ruta de home */
    Route::get('/home', 'HomeController@index')->name('home');
    
    /**Ruta de los archivos del equipo */
    Route::get('equipos/ficha/{id}', 'EquipmentController@downloadFichaTecnica')->name('download_fichaTecnica')
        ->middleware('can:datasheet.download');
    Route::get('equipos/manual/{id}', 'EquipmentController@downloadManual')->name('download_Manual')
        ->middleware('can:equipmentmanual.download');

    /**Ruta PDF dompdf */
    Route::get('pdf', 'EquipmentLoanedController@exportPDF')->name('equiposprestamos.pdfexport');
    Route::get('pdf-mantenimiento', 'MantenimientoController@exportPDF')->name('mantenimientos.pdfexport');
    
    /**Ruta EXCEL exprot */
    Route::get('equiposprestamos-excel', 'EquipmentLoanedController@exportar_equipos_prestamos_excel')->name('equiposprestamos.excelexport')
        ->middleware('can:report.download');
    Route::get('equipos-excel', 'EquipmentController@exportar_equipos_excel')->name('equipos.excelexport')
        ->middleware('can:report.download');
    Route::get('sistemas-excel', 'SystemController@exportar_sistemas_excel')->name('sistemas.excelexport')
        ->middleware('can:report.download');
    Route::get('criticidades-excel', 'CriticalityController@exportar_criticidades_excel')->name('criticidades.excelexport')
        ->middleware('can:report.download');
    Route::get('users-excel', 'UserController@exportar_users_excel')->name('users.excelexport')
        ->middleware('can:report.download');
    
    /**Ruta Roles*/
    Route::post('roles/store', 'RoleController@store')->name('roles.store')
        ->middleware('can:roles.create');
    Route::get('roles', 'RoleController@index')->name('roles.index')
        ->middleware('can:roles.index');
    Route::get('roles/create', 'RoleController@create')->name('roles.create')
        ->middleware('can:roles.create');
    Route::put('roles/{role}', 'RoleController@update')->name('roles.update')
        ->middleware('can:roles.edit');
    Route::get('roles/{role}', 'RoleController@show')->name('roles.show')
        ->middleware('can:roles.show');
    Route::delete('roles/{role}', 'RoleController@destroy')->name('roles.destroy')
        ->middleware('can:roles.destroy');
    Route::get('roles/{role}/edit', 'RoleController@edit')->name('roles.edit')
        ->middleware('can:roles.edit');

    /**Ruta Users */
    Route::get('users', 'UserController@index')->name('users.index')
        ->middleware('can:users.index');
    Route::get('users/crear', 'UserController@create')->name('users.create')
        ->middleware('can:users.create');
    Route::post('users', 'UserController@store')->name('users.store')
        ->middleware('can:users.create');
    Route::put('users-update/{user}', 'UserController@update')->name('users.update')
        ->middleware('can:users.edit');
    Route::get('users/{id}', 'UserController@show')->name('users.show')
        ->middleware('can:users.show');
    Route::delete('users/{user}', 'UserController@destroy')->name('users.destroy')
        ->middleware('can:users.destroy');
    Route::get('users/{id}/edit', 'UserController@edit')->name('users.edit')
        ->middleware('can:users.edit');
    Route::get('users-search/search', 'UserController@search')->name('users.search');
    
    /**Ruta para desactivar  a los usurios registrados en el sistema */
    Route::get('users/{user}/activar', 'UserController@activar')->name('users.activar')
        ->middleware('can:users.index');
        
    /**Ruta para eliminar a usuario definitivamente de la base de datos */
    Route::delete('users/{user}/eliminar', 'UserController@eliminar_completamente_user')->name('users.destroy_all')
        ->middleware('can:users.index');
    
    /**Ruta  Mi perfil*/
    Route::get('users/{id}/update-perfiles', 'UserController@ver')->name('users.ver');//manda al modulo actualizar perfil
    Route::post('users/{user}/update/perfil/password', 'UserController@updatePassword')->name('users.updatePassword');//para actualizar la contraseña del usuario 
    Route::put('users/{user}/update/avatar', 'UserController@updateAvatar')->name('users.updateAvatar');//para actualizar los datos básicos del usuario
    Route::put('users/{user}/update/users/datos/perfil', 'UserController@updateDatosUsuario')->name('users.updateDatosUsuario');//para actualizar los datos básicos del usuario

    Route::put('users-update/{user}/update/roles-usuario-registrado', 'UserController@updateRol')->name('users.updateRol');//para actualizar los datos básicos del usuario
    Route::put('users-update/{user}/update/asignacion/de/laboratorios/usuario', 'UserController@updateASignacionLaboratorio')->name('users.updateASignacionLaboratorio');//para actualizar los datos básicos del usuario


    
    /**Rutas localizaciones (Laboratorios)*/
    Route::get('laboratorios', 'LocationsController@index')->name('localizaciones.index')
        ->middleware('can:localizaciones.index');
    Route::get('laboratorios/crear', 'LocationsController@create')->name('localizaciones.create')
        ->middleware('can:localizaciones.create');
    Route::post('laboratorios', 'LocationsController@store')->name('localizaciones.store')
        ->middleware('can:localizaciones.create');
    Route::get('laboratorios/{id}/editar', 'LocationsController@edit')->name('localizaciones.edit')
        ->middleware('can:localizaciones.edit');
    Route::put('laboratorios/{id}', 'LocationsController@update')->name('localizaciones.update')
        ->middleware('can:localizaciones.edit');
    Route::delete('laboratorios/{id}', 'LocationsController@destroy')->name('locaclizaciones.destroy')
        ->middleware('can:localizaciones.destroy');
    Route::get('laboratorios/{id}', 'LocationsController@show')->name('localizaciones.show')
        ->middleware('can:localizaciones.show');
    Route::get('laboratorios-search/search', 'LocationsController@search')->name('localizaciones.search');

    /**Rutas áreas*/
    Route::get('areas', 'AreaController@index')->name('areas.index')
        ->middleware('can:areas.index');
    Route::get('areas/crear', 'AreaController@create')->name('areas.create')
        ->middleware('can:areas.create');
    Route::post('areas', 'AreaController@store')->name('areas.store')
        ->middleware('can:areas.create');
    Route::get('areas/{id}/editar', 'AreaController@edit')->name('areas.edit')
        ->middleware('can:areas.edit');
    Route::put('areas/{id}', 'AreaController@update')->name('areas.update')
        ->middleware('can:areas.edit');
    Route::delete('areas/{id}', 'AreaController@destroy')->name('areas.destroy')
        ->middleware('can:areas.destroy');
    Route::get('areas/{id}', 'AreaController@show')->name('areas.show')
        ->middleware('can:areas.show');
    Route::get('areas-search/search', 'AreaController@search')->name('areas.search');

    /**Rutas sistemas*/
    Route::get('sistemas', 'SystemController@index')->name('sistemas.index')
        ->middleware('can:sistemas.index');
    Route::get('sistemas/crear', 'SystemController@create')->name('sistemas.create')
        ->middleware('can:sistemas.create');
    Route::post('sistemas', 'SystemController@store')->name('sistemas.store')
        ->middleware('can:sistemas.create');
    Route::get('sistemas/{id}/editar', 'SystemController@edit')->name('sistemas.edit')
        ->middleware('can:sistemas.edit');
    Route::put('sistemas/{id}', 'SystemController@update')->name('sistemas.update')
        ->middleware('can:sistemas.edit');
    Route::delete('sistemas/{id}', 'SystemController@destroy')->name('sistemas.destroy')
        ->middleware('can:sistemas.destroy');
    Route::get('sistemas/{id}', 'SystemController@show')->name('sistemas.show')
        ->middleware('can:sistemas.show');
    Route::get('sistemas-search/search', 'SystemController@search')->name('sistemas.search');

    /*Rutas equipos*/
    Route::get('equipos', 'EquipmentController@index')->name('equipos.index')
        ->middleware('can:equipos.index');
    Route::get('equipos/crear', 'EquipmentController@create')->name('equipos.create')
        ->middleware('can:equipos.create');
    Route::post('equipos', 'EquipmentController@store')->name('equipos.store')
        ->middleware('can:equipos.create');
    Route::get('equipos/{id}/editar', 'EquipmentController@edit')->name('equipos.edit')
        ->middleware('can:equipos.edit');
    Route::put('equipos/{id}', 'EquipmentController@update')->name('equipos.update')
        ->middleware('can:equipos.edit');
    Route::delete('equipos/{id}', 'EquipmentController@destroy')->name('equipos.destroy')
        ->middleware('can:equipos.destroy');
    Route::get('equipos/{id}', 'EquipmentController@show')->name('equipos.show')
        ->middleware('can:equipos.show');
    Route::get('equipos-search/search', 'SystemController@searchEquipment')->name('equipos.search');

    /*Rutas elementos*/
    Route::get('elementos', 'ElementController@index')->name('elementos.index')
        ->middleware('can:elementos.index');
    Route::get('elementos/crear/{id}', 'ElementController@create')->name('elementos.create')
        ->middleware('can:elementos.create');
    Route::post('elementos', 'ElementController@store')->name('elementos.store')
        ->middleware('can:elementos.create');
    Route::get('elementos/{id}/editar', 'ElementController@edit')->name('elementos.edit')
        ->middleware('can:elementos.edit');
    Route::put('elementos/{id}', 'ElementController@update')->name('elementos.update')
        ->middleware('can:elementos.edit');
    Route::delete('elementos/{id}', 'ElementController@destroy')->name('elementos.destroy')
        ->middleware('can:elementos.destroy');
    Route::get('elementos/{id}', 'ElementController@show')->name('elementos.show')
        ->middleware('can:elementos.show');

    /**Ruta equipos prestados*/
    Route::get('equipo-prestamo', 'EquipmentLoanedController@index')->name('equiposprestamos.index')
        ->middleware('can:equiposprestamos.index');
    Route::get('equipo-prestamo/crear', 'EquipmentLoanedController@create')->name('equiposprestamos.create')
        ->middleware('can:equiposprestamos.create');
    Route::post('equipo-prestamo', 'EquipmentLoanedController@store')->name('equiposprestamos.store')
        ->middleware('can:equiposprestamos.create');
    Route::get('equipo-prestamo/{id}/editar', 'EquipmentLoanedController@edit')->name('equiposprestamos.edit')
        ->middleware('can:equiposprestamos.edit');
    Route::put('equipo-prestamo/{id}', 'EquipmentLoanedController@update')->name('equiposprestamos.update')
        ->middleware('can:equiposprestamos.edit');
    
    /**Ruta del historial de equipos prestados */
    Route::get('equipo-prestamo/search', 'EquipmentLoanedController@search')->name('equiposprestamos.search');
    Route::get('equipo-prestamo/searchHistorial', 'EquipmentLoanedController@searchHistorial')->name('equiposprestamos.searchHistorial');
    Route::get('equipo-prestamo/historial', 'EquipmentLoanedController@historial')->name('equiposprestamos.historial')
        ->middleware('can:equiposprestamos.index');


    /*Ruta criticidades*/
    Route::get('criticidades', 'CriticalityController@index')->name('criticidades.index')
        ->middleware('can:criticidades.index');
    Route::get('criticidades/crear/{id}', 'CriticalityController@create')->name('criticidades.create')
        ->middleware('can:criticidades.create');
    Route::post('criticidades', 'CriticalityController@store')->name('criticidades.store')
        ->middleware('can:criticidades.create');
    Route::get('criticidades/{id}/editar', 'CriticalityController@edit')->name('criticidades.edit')
        ->middleware('can:criticidades.edit');
    Route::put('criticidades/{id}', 'CriticalityController@update')->name('criticidades.update')
        ->middleware('can:criticidades.edit');
    Route::delete('criticidades/{id}', 'CriticalityController@destroy')->name('criticidades.destroy')
        ->middleware('can:criticidades.destroy');
    Route::get('criticidades/{id}', 'CriticalityController@show')->name('criticidades.show')
        ->middleware('can:criticidades.show');

    /**Ruta notificaciones (mensajes de mantenimiento)*/    
    Route::get('/messages', 'MessageController@index')->name('messages.index')
        ->middleware('can:messages.index');
    Route::post('/messages/store', 'MessageController@store')->name('messages.store')
        ->middleware('can:messages.create');
    Route::get('messages/{id}', 'MessageController@show')->name('messages.show')
        ->middleware('can:messages.show');

    Route::get('/messages/info/{id}', 'MessageController@leido')->name('messages.info');//para marcar como leido la notificacion
    Route::put('messages-mantenimiento/{id}', 'MessageController@mantenimiento')->name('messages.mantenimiento');//para marcar como realizado el mantenimiento y remover de la lista de tareas

    /**Ruta reportes */
    Route::get('reportes', 'ReporteController@index')->name('reporte.index')
        ->middleware('can:report.download');

    /**Ruta mantenimientos */
    Route::get('mantenimiento', 'MantenimientoController@index')->name('mantenimientos.index')
        ->middleware('can:mantenimientos.index');
    Route::delete('mantenimiento/{id}', 'MantenimientoController@destroy')->name('mantenimientos.destroy')
        ->middleware('can:mantenimientos.destroy');
        Route::get('mantenimientos/search', 'MantenimientoController@search')->name('mantenimientos.search');
});

