DELETE  from public.productos;

-- Inserto Productos y la formulacion de queso sardo
INSERT INTO public.productos(
   nombre, descripcion, "tipoUnidad", codigo, "alarmaActiva", "alarmaAmarilla", "alarmaRoja", categoria, estado, created_at, updated_at)
VALUES ( 'Queso Sardo', 'producto lacteo queso sardo', 'kg', 'pl01', 'false', NULL , NULL , 'lacteo' , TRUE , now(), now());

INSERT INTO public.productos(
  nombre, descripcion, "tipoUnidad", codigo, "alarmaActiva", "alarmaAmarilla", "alarmaRoja", categoria, estado, created_at, updated_at)
VALUES ( 'Leche', 'insumo lacteo', 'l', 'pl02', 'false', NULL , NULL , 'lacteo' , true, now(), now());

INSERT INTO public.productos(
  nombre, descripcion, "tipoUnidad", codigo, "alarmaActiva", "alarmaAmarilla", "alarmaRoja", categoria, estado, created_at, updated_at)
VALUES ( 'Sal', 'insumo', 'gr', 'i01', 'true', 10 , 5 , 'insumo' , true, now(), now());

INSERT INTO public.productos(
  nombre, descripcion, "tipoUnidad", codigo, "alarmaActiva", "alarmaAmarilla", "alarmaRoja", categoria, estado, created_at, updated_at)
VALUES ( 'Fermento', 'insumo', 'gr', 'i02', 'false', NULL , NULL , 'insumo' , true, now(), now());

-- formulacion alta en la tabla intermedia
DELETE from public.producto_productoi;
INSERT INTO public.producto_productoi(
  producto_id, ingrediente_id, cantidad, "cantidadProducto")
VALUES (1, 2, 2, 1);

INSERT INTO public.producto_productoi(
  producto_id, ingrediente_id, cantidad, "cantidadProducto")
VALUES (1, 3, 250, 1);

INSERT INTO public.producto_productoi(
  producto_id, ingrediente_id, cantidad, "cantidadProducto")
VALUES (1, 4, 50, 1);


-- Creo lotes y sus movimientos
DELETE from public.lotes;
--entrada de sal
INSERT INTO public.lotes(
  producto_id, "tipoLote", "fechaInicio", "fechaInicioMaduracion", "fechaFinalizacion", "fechaVencimiento", "cantidadElaborada", "cantidadFinal", "tipoTP", asignatura, costounitario, created_at, updated_at)
VALUES ( 3, 3, '2018-05-04', NULL , '2018-05-04', '2019-01-01', 2000, 2000, false, NULL , 0.5, now(), now());
--entrada fermento
INSERT INTO public.lotes(
  producto_id,"tipoLote", "fechaInicio", "fechaInicioMaduracion", "fechaFinalizacion", "fechaVencimiento", "cantidadElaborada", "cantidadFinal", "tipoTP", asignatura, costounitario, created_at, updated_at)
VALUES ( 4, 3, '2018-05-04', NULL , '2018-05-04', '2018-10-01', 1000, 1000, false, NULL , 0.1 , now(), now());
--entrada leche
INSERT INTO public.lotes(
  producto_id,"tipoLote", "fechaInicio", "fechaInicioMaduracion", "fechaFinalizacion", "fechaVencimiento", "cantidadElaborada", "cantidadFinal", "tipoTP", asignatura, costounitario, created_at, updated_at)
VALUES ( 2, 3, '2018-05-04', NULL , '2018-05-04', '2018-10-01', 100, 100, false, NULL , 0.1 , now(), now());
--entrada queso sardo real
INSERT INTO public.lotes(
  producto_id,"tipoLote", "fechaInicio", "fechaInicioMaduracion", "fechaFinalizacion", "fechaVencimiento", "cantidadElaborada", "cantidadFinal", "tipoTP", asignatura, costounitario, created_at, updated_at)
VALUES ( 1, 3, '2018-05-05', NULL , '2018-05-05', '2018-10-01', 10, 10, false, NULL , 0.1 , now(), now());

INSERT INTO public.lotes(
	 producto_id, "tipoLote", "fechaInicio", "fechaInicioMaduracion", "fechaFinalizacion", "fechaVencimiento", "cantidadElaborada", "cantidadFinal", "tipoTP", asignatura, costounitario, created_at, updated_at)
	VALUES ( 3, 3, '2018-05-06', NULL , '2018-05-06', '2019-01-01', 2000, 2000, false, NULL , 0.5, now(), now());
--entrada fermento
INSERT INTO public.lotes(
	 producto_id,"tipoLote", "fechaInicio", "fechaInicioMaduracion", "fechaFinalizacion", "fechaVencimiento", "cantidadElaborada", "cantidadFinal", "tipoTP", asignatura, costounitario, created_at, updated_at)
	VALUES ( 4, 3, '2018-05-06', NULL , '2018-05-06', '2018-10-01', 1000, 1000, false, NULL , 0.1 , now(), now());
--planificado de queso sardo
INSERT INTO public.lotes(
	 producto_id,"tipoLote", "fechaInicio", "fechaInicioMaduracion", "fechaFinalizacion", "fechaVencimiento", "cantidadElaborada", "cantidadFinal", "tipoTP", asignatura, costounitario, created_at, updated_at)
	VALUES ( 1, 4, '2018-05-07' , NULL , '2018-05-06' , '2018-10-01', 10, 10, false, NULL , NULL , now(), now());


--movimientos
--entrada insumos
DELETE FROM  public.movimientos;
INSERT INTO public.movimientos(
  "idLoteConsumidor", "idLoteIngrediente", fecha, producto_id, debe, haber, "saldoGlobal", "saldoLote", tipo, planificacion_id, created_at, updated_at)
VALUES ( 1, 1, '2018-05-04 00:00:01' , 3, 0, 2500, 2500, 2500, 1, NULL , now(), now());

INSERT INTO public.movimientos(
  "idLoteConsumidor", "idLoteIngrediente", fecha, producto_id, debe, haber, "saldoGlobal", "saldoLote", tipo, planificacion_id, created_at, updated_at)
VALUES ( 2, 2, '2018-05-04 00:00:02', 4, 0, 1000, 1000, 1000, 1, NULL , now(), now());

INSERT INTO public.movimientos(
  "idLoteConsumidor", "idLoteIngrediente", fecha, producto_id, debe, haber, "saldoGlobal", "saldoLote", tipo, planificacion_id, created_at, updated_at)
VALUES ( 3, 3, '2018-05-04 00:00:02', 2, 0, 100, 100, 100, 1, NULL , now(), now());

--consumos reales del queso sardo
INSERT INTO public.movimientos(
  "idLoteConsumidor", "idLoteIngrediente", fecha, producto_id, debe, haber, "saldoGlobal", "saldoLote", tipo, planificacion_id, created_at, updated_at)
VALUES ( 4, 1, '2018-05-05 00:00:01' , 3, 2500, 0, 0, 0, 5, NULL , now(), now());

INSERT INTO public.movimientos(
  "idLoteConsumidor", "idLoteIngrediente", fecha, producto_id, debe, haber, "saldoGlobal", "saldoLote", tipo, planificacion_id, created_at, updated_at)
VALUES ( 4, 2, '2018-05-05 00:00:02', 4, 500, 0, 500, 500, 5, NULL , now(), now());

INSERT INTO public.movimientos(
  "idLoteConsumidor", "idLoteIngrediente", fecha, producto_id, debe, haber, "saldoGlobal", "saldoLote", tipo, planificacion_id, created_at, updated_at)
VALUES ( 4, 3, '2018-05-05 00:00:03', 2, 20, 0, 80, 80, 5, NULL , now(), now());
--entrada queso sardo
INSERT INTO public.movimientos(
  "idLoteConsumidor", "idLoteIngrediente", fecha, producto_id, debe, haber, "saldoGlobal", "saldoLote", tipo, planificacion_id, created_at, updated_at)
VALUES ( 4, 4, '2018-05-05 00:00:05', 1, 0, 10, 10, 10, 1, NULL , now(), now());

--entradas insumos
INSERT INTO public.movimientos(
  "idLoteConsumidor", "idLoteIngrediente", fecha, producto_id, debe, haber, "saldoGlobal", "saldoLote", tipo, planificacion_id, created_at, updated_at)
VALUES ( 5, 5, '2018-05-06 00:00:01' , 3, 0, 2000, 2000, 2000, 1, NULL , now(), now());

INSERT INTO public.movimientos(
  "idLoteConsumidor", "idLoteIngrediente", fecha, producto_id, debe, haber, "saldoGlobal", "saldoLote", tipo, planificacion_id, created_at, updated_at)
VALUES ( 6, 6, '2018-05-06 00:00:02', 4, 0, 1000, 1500, 1000, 1, NULL , now(), now());

--consumo planif sal
INSERT INTO public.movimientos(
  "idLoteConsumidor", "idLoteIngrediente", fecha, producto_id, debe, haber, "saldoGlobal", "saldoLote", tipo, planificacion_id, created_at, updated_at)
VALUES ( 7, NULL , '2018-05-07 00:00:01', 3, 1000, 0, 1000, NULL , 9, NULL , now(), now());

--consumo planif fermento
INSERT INTO public.movimientos(
  "idLoteConsumidor", "idLoteIngrediente", fecha, producto_id, debe, haber, "saldoGlobal", "saldoLote", tipo, planificacion_id, created_at, updated_at)
VALUES ( 7, NULL , '2018-05-07 00:00:02', 4, 500, 0, 1000, NULL , 9, NULL , now(), now());

--consumo planif leche
INSERT INTO public.movimientos(
  "idLoteConsumidor", "idLoteIngrediente", fecha, producto_id, debe, haber, "saldoGlobal", "saldoLote", tipo, planificacion_id, created_at, updated_at)
VALUES ( 7, NULL , '2018-05-07 00:00:03', 2, 10, 0, 70, NULL , 9, NULL , now(), now());

--Entrada producto planif Queso sardo
INSERT INTO public.movimientos(
  "idLoteConsumidor", "idLoteIngrediente", fecha, producto_id, debe, haber, "saldoGlobal", "saldoLote", tipo, planificacion_id, created_at, updated_at)
VALUES ( 7, 7, '2018-05-07 00:00:05', 1, 0, 5, 15, 5, 8, 1, now(), now());
--Entrada de leche planif
INSERT INTO public.movimientos(
    "idLoteConsumidor", "idLoteIngrediente", fecha, producto_id, debe, haber, "saldoGlobal", "saldoLote", tipo, planificacion_id, created_at, updated_at)
VALUES ( NULL , NULL , '2018-05-07 00:00:00', 2, 0, 100, 100, 100, 7, 1, now(), now());
--Entrada sal Planificada
INSERT INTO public.movimientos(
  "idLoteConsumidor", "idLoteIngrediente", fecha, producto_id, debe, haber, "saldoGlobal", "saldoLote", tipo, planificacion_id, created_at, updated_at)
VALUES ( NULL , NULL , '2018-05-10 00:00:00', 3, 0, 10000, 11000, NULL , 7, 4, now(), now());

--Planificaciones
DELETE from public.planificacions;

INSERT INTO public.planificacions(
	fecha, "diaSemana", descripcion, created_at, updated_at)
	VALUES ( '2018-05-07', 'lunes', '', now(), now());
INSERT INTO public.planificacions(
  fecha, "diaSemana", descripcion, created_at, updated_at)
VALUES ( '2018-05-08', 'martes', '', now(), now());
INSERT INTO public.planificacions(
  fecha, "diaSemana", descripcion, created_at, updated_at)
VALUES ( '2018-05-09', 'miercoles', '', now(), now());
INSERT INTO public.planificacions(
  fecha, "diaSemana", descripcion, created_at, updated_at)
VALUES ( '2018-05-10', 'jueves', '', now(), now());
INSERT INTO public.planificacions(
  fecha, "diaSemana", descripcion, created_at, updated_at)
VALUES ( '2018-05-11', 'viernes', '', now(), now());

--Trabajadores
DELETE from public.trabajadors;

INSERT INTO public.trabajadors(
	 legajo, "idPersona", sector, puesto, seudonimo, estado, created_at, updated_at)
	VALUES ( 1, 1, 'produccion', '', 'Jorge', true, now(), now());

INSERT INTO public.trabajadors(
	 legajo, "idPersona", sector, puesto, seudonimo, estado, created_at, updated_at)
	VALUES ( 2, 2, 'produccion', '', 'Tito', true, now(), now());

--Asigno los trabajadores a las planificaciones
DELETE from public.planificacion_trabajador;

INSERT INTO public.planificacion_trabajador(
  planificacion_id, trabajador_id)
    VALUES (1,1);

INSERT INTO public.planificacion_trabajador(
  planificacion_id, trabajador_id)
VALUES (1,2);

INSERT INTO public.planificacion_trabajador(
  planificacion_id, trabajador_id)
VALUES (2,1);

INSERT INTO public.planificacion_trabajador(
  planificacion_id, trabajador_id)
VALUES (2,2);

INSERT INTO public.planificacion_trabajador(
  planificacion_id, trabajador_id)
VALUES (3,1);

INSERT INTO public.planificacion_trabajador(
  planificacion_id, trabajador_id)
VALUES (3,2);

INSERT INTO public.planificacion_trabajador(
  planificacion_id, trabajador_id)
VALUES (4,1);

INSERT INTO public.planificacion_trabajador(
  planificacion_id, trabajador_id)
VALUES (4,2);

INSERT INTO public.planificacion_trabajador(
  planificacion_id, trabajador_id)
VALUES (5,1);

INSERT INTO public.planificacion_trabajador(
  planificacion_id, trabajador_id)
VALUES (5,2);