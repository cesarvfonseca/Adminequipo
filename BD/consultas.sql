/*EQUIPOS*/
SELECT * FROM equipos;
CALL ultimoidEquipos('PC%');
SELECT MAX(substr(cod_equipo,3,1)) AS id FROM equipos WHERE cod_equipo LIKE 'MQ%';

INSERT INTO `equipos`
(`cod_equipo`, `tipo`, `marca`, `modelo`, `numero_serie`, `numero_producto`, `numero_factura`, `fecha_factura`, `disco_duro`, `ram`, `sistema_operativo`, `comentarios`, `status`, `RESPONSABLES_cod_resp`) 
VALUES ('PC1','PC','HP','GIB','FSDFSDFSDF','RTSDFSDFSDFRTRT','A78883','2016-01-01','1TB','8GB','WIN7','N/A','A','HL3');

/*RESPONSABLES*/
CALL ultimoidResponsable;
SELECT MAX(substr(cod_resp,3,1)) AS id FROM responsables;

SELECT * FROM responsables;

CALL insertarResponsable('HL3','Hitomi','Laine','Auxiliar de sistemas','Corporativo','Sistemas','hitomi.laine@mexq.com.mx','2016-11-23');
INSERT INTO `responsables`
(`cod_resp`, `nombre`, `apellido`, `puesto`, `sucursal`, `planta_depto`, `correo`, `fecha`) 
VALUES ('GH2','Gabriela','Hernandez','Auxiliar de ventas','Corporativo','VEntas','ghernandez@mexq.com.mx','2016-01-01');

/*COMPUTADORAS + RESPONSABLES*/
CALL comp_resp;
SELECT e.cod_equipo,CONCAT(r.nombre,' ',r.apellido) as nombre,r.puesto,r.sucursal,r.planta_depto,e.marca,e.modelo,e.numero_serie,e.numero_producto,e.numero_factura,e.status,e.comentarios
FROM equipos as e
INNER JOIN responsables as r
WHERE e.RESPONSABLES_cod_resp=r.cod_resp;

