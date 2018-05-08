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
	VALUES ( 3, 3, '2018-05-06', NULL , '2018-05-06', '2019-01-01', 2000, 2000, false, NULL , 0.5, now(), now());
--entrada fermento
INSERT INTO public.lotes(
	 producto_id,"tipoLote", "fechaInicio", "fechaInicioMaduracion", "fechaFinalizacion", "fechaVencimiento", "cantidadElaborada", "cantidadFinal", "tipoTP", asignatura, costounitario, created_at, updated_at)
	VALUES ( 4, 3, '2018-05-06', NULL , '2018-05-06', '2018-10-01', 1000, 1000, false, NULL , 0.1 , now(), now());
--planificado de queso sardo
INSERT INTO public.lotes(
	 producto_id,"tipoLote", "fechaInicio", "fechaInicioMaduracion", "fechaFinalizacion", "fechaVencimiento", "cantidadElaborada", "cantidadFinal", "tipoTP", asignatura, costounitario, created_at, updated_at)
	VALUES ( 1, 4, '2018-05-07' , NULL , '2018-05-06' , '2018-10-01', 5, 5, false, NULL , NULL , now(), now());


--movimientos
--entradas insumos
INSERT INTO public.movimientos(
  "idLoteConsumidor", "idLoteIngrediente", fecha, codigo, debe, haber, saldoglobal, "saldoLote", tipo, planificacion_id, created_at, updated_at)
VALUES ( 1, 1, '2018-05-06 00:00:01' , 'i01', 0, 2000, 2000, 2000, 1, NULL , now(), now());

INSERT INTO public.movimientos(
  "idLoteConsumidor", "idLoteIngrediente", fecha, codigo, debe, haber, saldoglobal, "saldoLote", tipo, planificacion_id, created_at, updated_at)
VALUES ( 2, 2, '2018-05-06 00:00:02', 'i02', 0, 1000, 1000, 1000, 1, NULL , now(), now());

--consumo planif sal
INSERT INTO public.movimientos(
  "idLoteConsumidor", "idLoteIngrediente", fecha, codigo, debe, haber, saldoglobal, "saldoLote", tipo, planificacion_id, created_at, updated_at)
VALUES ( 3, NULL , '2018-05-07 00:00:01', 'i01', 1000, 0, 1000, NULL , 9, NULL , now(), now());

--consumo planif fermento
INSERT INTO public.movimientos(
  "idLoteConsumidor", "idLoteIngrediente", fecha, codigo, debe, haber, saldoglobal, "saldoLote", tipo, planificacion_id, created_at, updated_at)
VALUES ( 3, NULL , '2018-05-07 00:00:02', 'i02', 500, 0, 500, NULL , 9, NULL , now(), now());

--consumo planif leche
INSERT INTO public.movimientos(
  "idLoteConsumidor", "idLoteIngrediente", fecha, codigo, debe, haber, saldoglobal, "saldoLote", tipo, planificacion_id, created_at, updated_at)
VALUES ( 3, NULL , '2018-05-07 00:00:03', 'pl02', 10, 0, -10, NULL , 9, NULL , now(), now());

--Entrada producto planif Queso sardo
INSERT INTO public.movimientos(
  "idLoteConsumidor", "idLoteIngrediente", fecha, codigo, debe, haber, saldoglobal, "saldoLote", tipo, planificacion_id, created_at, updated_at)
VALUES ( 3, 3, '2018-05-07 00:00:05', 'pl01', 0, 5, 5, 5, 8, 1, now(), now());
--Entrada de leche planif
INSERT INTO public.movimientos(
    "idLoteConsumidor", "idLoteIngrediente", fecha, codigo, debe, haber, saldoglobal, "saldoLote", tipo, planificacion_id, created_at, updated_at)
VALUES ( NULL , NULL , '2018-05-07 00:00:00', 'pl02', 0, 100, 100, 100, 7, 1, now(), now());

--Planificacion
DELETE from public.planificacions;

INSERT INTO public.planificacions(
	fecha, "diaSemana", descripcion, created_at, updated_at)
	VALUES ( '2018-05-07', 'lunes', '', now(), now());

--Trabajadores
DELETE from public.trabajadors;
INSERT INTO public.trabajadors(
	 legajo, "idPersona", sector, puesto, seudonimo, estado, created_at, updated_at)
	VALUES ( 1, 1, 'produccion', '', 'Jorge', true, now(), now());

INSERT INTO public.trabajadors(
	 legajo, "idPersona", sector, puesto, seudonimo, estado, created_at, updated_at)
	VALUES ( 2, 2, 'produccion', '', 'Tito', true, now(), now());

--Asigno los trabajadores a la planificacion
