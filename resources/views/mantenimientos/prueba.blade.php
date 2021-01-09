use sipmw;
################################################
###     Store Procedure locations
################################################


################################################
###     Store Procedure Areas
################################################
DELIMITER $$
CREATE PROCEDURE sp_create_localizacion(
IN codeUser int
)
BEGIN
	SELECT locations.`id`, locations.`code`, locations.`name`, locations.`description`, `telephone`, `ext` 
	FROM `locations`
	INNER JOIN locations_user
	on(locations_user.locations_id = locations.id)
	INNER JOIN users
	ON (users.id = locations_user.users_id) 
	WHERE locations_user.locations_id = locations.id
	AND locations_user.users_id = codeUser;
END$$
DELIMITER ;

################################################
###     Store Procedure systems
################################################
DELIMITER $$
CREATE PROCEDURE sp_insertar_sistema(
	IN code VARCHAR(10),
    IN areas_id INT,
    IN name VARCHAR(190)
	)
BEGIN
	INSERT INTO `systems`(`code`, `areas_id`,`name`) 
    VALUES (code, areas_id, name);
END$$
DELIMITER ;

################################################
###     Store Procedure equipment
################################################
DELIMITER $$
CREATE PROCEDURE sp_mostrarAreasLab(
IN code_user_para_area INT
)
BEGIN
	SELECT 
	areas.id as id,areas.code as code, locations.code as locations_id

	FROM areas
	INNER JOIN locations
		ON(areas.locations_id = locations.id)
	INNER JOIN locations_user
		ON(locations_user.locations_id = locations.id)
	INNER JOIN users
		ON (users.id = locations_user.users_id)
	WHERE locations_user.locations_id = locations.id
		AND locations_user.users_id = code_user_para_area;
  	END$$
DELIMITER ;
  
DELIMITER $$
CREATE PROCEDURE sp_mostrarEquipo(
IN code_EQUIPO INT
)
BEGIN
SELECT 
	locations.code as loc_id,
	locations.name as loc_nomb,
    areas.code as area_id,
	areas.name as area_nomb,	
	systems.code as sist_id,
	systems.name as sist_nomb,
    equipment.imagen as imagen
	FROM equipment
	INNER JOIN systems
	ON (systems.id = equipment.systems_id)
	INNER JOIN areas
	ON (areas.id = systems.areas_id)
    INNER JOIN locations
	ON (locations.id = areas.locations_id)
    WHERE (equipment.id = code_EQUIPO);
	END$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE sp_mostrarCriticidad(
IN code_EQUIPO_CRITICIDAD INT
)
BEGIN
    SELECT 
    criticalities.id as crit_id,
	criticalities.frequency as crit_fre,
	criticalities.operationalImpact as operationalImpact,
	criticalities.flexibility as flexibility,
	criticalities.maintenanceCost as maintenanceCost,
	criticalities.impactToSafety as impactToSafety,
	criticalities.consequences as consequences,
	criticalities.total as total,
	availabilities.name as crit_disponibilidad,
	maintenance_model.name as crit_maintenance_model
	FROM criticalities
    INNER JOIN equipment
	ON (equipment.id = criticalities.equipment_id)
	INNER JOIN availabilities
	ON (availabilities.id = criticalities.availabilities_id)
    INNER JOIN maintenance_model
	ON (maintenance_model.id = criticalities.maintenance_model_id)
    WHERE (equipment.id = code_EQUIPO_CRITICIDAD);
	END$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE sp_info_sistema(
IN code_EQUIPO INT
)
BEGIN
    SELECT 
		systems.id as sist_id,
		areas.locations_id as locations_id,
		systems.areas_id as areas_id
	FROM equipment
	INNER JOIN systems
    ON (systems.id = equipment.systems_id)
    INNER JOIN areas
	ON (areas.id = systems.areas_id)
    INNER JOIN locations
	ON (locations.id = areas.locations_id)
    WHERE (equipment.id = code_EQUIPO);
END$$
DELIMITER;

DELIMITER $$
CREATE PROCEDURE sp_mostrarelements(
IN code_ELEMENTO INT
)
BEGIN
    SELECT 
	elements.id as elem_id,
	elements.name as elem_nomb,
	elements.number_of as number_of,
	elements.description as elem_descrp,
	elements.function as elem_func,
	elements.imagen as elem_img,
	elements.faultDescription as elem_descFallo,
	type_failures.name as elem_tipoFallo,
	elements.failMode as failMode,
	classifications.name as clasificacion,
	elements.maintenanceActivity as maintenanceActivity,
    elements.maintenanceTask as maintenanceTask,
    elements.improvements as improvements,
	frequencys.name as elem_fre
	FROM elements
	INNER JOIN equipment
	ON (elements.equipment_id = equipment.id)
	INNER JOIN type_failures
	ON (elements.typefailures_id = type_failures.id)
    INNER JOIN classifications
	ON (elements.classifications_id = classifications.id)
    INNER JOIN frequencys
	ON (elements.frequencys_id = frequencys.id)
    WHERE (elements.equipment_id = code_ELEMENTO);
	END$$
DELIMITER ;

################################################
###     Store Procedure Prestar equipment
################################################

DELIMITER $$
CREATE PROCEDURE sp_exportar_EP_PDF(
	IN fecha_inicio varchar(190),
    IN fecha_fin varchar(190)
)
BEGIN
	SELECT
		equipment.id as equi_id,
        equipment.code as equi_code,
		equipment.name as equi_name,
        equipment.imagen as equi_imagen,
        ep.lent_by as lent_by,
		ep.name as user_prstate_a,
		ep.email as email,
		ep.facultad as facultad,
		ep.carrera as carrera,
		ep.fecha_prestamo as fecha_prestamo,
		ep.fecha_devolucion as fecha_devolucion,
        ep.observacion_prestamo as observacion_prestamo,
        ep.observacion_entrega as observacion_entrega
	FROM equipment_prestamos as ep
    INNER JOIN equipment
    ON (ep.equipment_id = equipment.id)
    WHERE fecha_prestamo BETWEEN fecha_inicio AND fecha_fin
    AND fecha_prestamo >= fecha_inicio and fecha_prestamo <= fecha_fin;
	END$$
DELIMITER ;

################################################
###     Store Procedure criticalities
################################################
DELIMITER $$
CREATE PROCEDURE sp_insertar_criticidad(
	IN equipment_id INT,
    IN frequency INT,
    IN operationalImpact INT,
    IN flexibility INT,
    IN maintenanceCost INT,
	IN impactToSafety INT,
    IN consequences INT,
    IN total INT,
    IN availabilities_id INT,
    IN maintenance_model_id INT
	)
BEGIN
	INSERT INTO `criticalities`(`equipment_id`, `frequency`, `operationalImpact`, `flexibility`, `maintenanceCost`, `impactToSafety`, `consequences`, `total`, `availabilities_id`, `maintenance_model_id`)
    VALUES (equipment_id, frequency,operationalImpact,flexibility,maintenanceCost,impactToSafety,consequences,total,availabilities_id,maintenance_model_id);
END$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE sp_showCriticidad(
IN code_SHOW_CRITICIDAD INT
)
BEGIN
    SELECT 
		c.id,
		c.equipment_id,
        e.name as nomb_equipo,
        c.frequency,
        c.operationalImpact,
        c.flexibility,
        c.maintenanceCost,
        c.impactToSafety,
        c.consequences,
        c.total,
        availabilities.name as crit_disponibilidad,
		maintenance_model.name as crit_maintenance_model
	FROM criticalities as c
	INNER JOIN equipment as e
	ON (c.equipment_id = e.id)
	INNER JOIN availabilities
	ON (availabilities.id = c.availabilities_id)
    INNER JOIN maintenance_model
	ON (maintenance_model.id = c.maintenance_model_id)
    WHERE (c.id = code_SHOW_CRITICIDAD);
	END$$
DELIMITER ;

################################################
###     Store Procedure elements
################################################
DELIMITER $$
CREATE PROCEDURE sp_insertar_elemento(
	IN equipment_id INT,
    IN name VARCHAR(190),
    IN number_of INT,
    IN description VARCHAR(255),
	IN function VARCHAR(255),
    IN image_elements VARCHAR(191),
    IN faultDescription VARCHAR(255),
    IN typefailures_id INT,
    IN failMode VARCHAR(255),
    IN classifications_id INT,
    IN maintenanceActivity VARCHAR(255),
	IN frequencys_id INT,
    IN maintenanceTask VARCHAR(191),
    IN improvements VARCHAR(255)
	)
BEGIN
	INSERT INTO `elements`(`equipment_id`, `name`, `number_of`, `description`, `function`, `imagen`, `faultDescription`, `typefailures_id`, `failMode`, `classifications_id`, `maintenanceActivity`, `frequencys_id`, `maintenanceTask`, `improvements`)
    VALUES (equipment_id, name, number_of, description, function, imagen, faultDescription, typefailures_id, failMode, classifications_id, maintenanceActivity, frequencys_id, maintenanceTask, improvements);
END$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE sp_showelements(
IN code_SHOW_ELEMENTO INT
)
BEGIN
SELECT elements.id as elem_id,
       elements.equipment_id as equipment_id,
       elements.name as elem_nomb,
       elements.number_of as number_of,
       elements.description as elem_descrp,
       elements.function as elem_func,
       elements.imagen as elem_img,
       elements.faultDescription as elem_descFallo,
       type_failures.name as elem_tipoFallo,
       elements.failMode as failMode,
       classifications.name as clasificacion,
       elements.maintenanceActivity as maintenanceActivity,
	   elements.maintenanceTask as maintenanceTask,
	   elements.improvements as improvements,
       frequencys.name as elem_fre 
	FROM `elements` 
	INNER JOIN equipment
	ON (elements.equipment_id = equipment.id)
	INNER JOIN type_failures
	ON (elements.typefailures_id = type_failures.id)
	INNER JOIN classifications
	ON (elements.classifications_id = classifications.id)
	INNER JOIN frequencys
	ON (elements.frequencys_id = frequencys.id)
	WHERE elements.id = code_SHOW_ELEMENTO;
END$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE sp_showelementsEdit(
IN code_SHOW_ELEMENT_EDIT INT
)
BEGIN
SELECT 
	elements.`id`, 
	`equipment_id`,
    equipment.code,
    elements.`name`, 
    `number_of`, 
    elements.`description`, 
    elements.`function`, 
    elements.`image_elements`, 
    `faultDescription`, 
    `typefailures_id`, 
    `failMode`, 
    `classifications_id`, 
    `maintenanceActivity`, 
    `frequencys_id`, 
    `maintenanceTask`, 
    `improvements` 
FROM `elements` 
INNER JOIN equipment
ON(elements.equipment_id = equipment.id)
WHERE elements.equipment_id = equipment.id
AND elements.id = code_SHOW_ELEMENT_EDIT;
END$$
DELIMITER ;

################################################
###     Store Procedure mensajes mantenimiento
################################################
DELIMITER $$
CREATE PROCEDURE sp_messages_users(IN auth_id INT)
BEGIN
	SELECT 
		users.id as uID,
		users.name as uNOMB,
        users.lastname as uAPELLIDO,
        roles.special as especial,
        locations.code as code,
		locations.name as name
    FROM users
	INNER JOIN role_user
	ON (users.id = role_user.user_id)
    INNER JOIN roles
	ON (roles.id = role_user.role_id)
    INNER JOIN locations_user
    ON(locations_user.users_id = users.id)
    INNER JOIN locations
    ON(locations_user.locations_id = locations.id)
    WHERE (users.id != auth_id AND users.state != 'INACTIVO' AND roles.name = 'Pasante');
END$$
DELIMITER ;
