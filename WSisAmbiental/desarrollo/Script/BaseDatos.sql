--exec S_Existe_Usuario ''
--exec S_Existe_Usuario null

alter Procedure S_Existe_Usuario
@use_id  varchar(20)
as
if exists (select *  from  TbUsuarios where use_id=@use_id)
begin
	select 1 as cant, use_name from TbUsuarios where use_id=@use_id
end
else
begin
	select 0
end

GO
 -- S_PermisoUsuario 'grodriguez'
alter Procedure S_PermisoUsuario 
@Usuario varchar(20),@nro varchar(4) output
as
if exists (select *  from  TbUsuarios where use_id = @Usuario)
begin
	select  @nro = Cod_nvl from  TbUsuarios where use_id = @Usuario
end
else
begin
	select @nro = 0
end
 
GO

/*
select count(*) as cant from  TbUsuarios where use_id='' or 'a'='a' and use_pwd='' or 'a'='a'
select count(*) as cant from  TbUsuarios where use_id='' or 'a'='a' and use_pwd=''
select count(*) as cant from  TbUsuarios where use_id='' or 'a'='a' and use_pwd=''    DROP TABLE TbUsuarios  select ''
*/
-- sp_listamenu 'grodriguez'
-- sp_listamenu 'lnunez'

alter proc sp_listamenu 
@Usuario varchar(20)
as
DECLARE @Id_nivel varchar(4)  , @select varchar(4000)
	exec S_PermisoUsuario @Usuario, @Id_nivel output
	 --select @Id_nivel
 
if @Id_nivel		='N001'  goto  Administrador           
else if @Id_nivel	='N002'  goto  ListaRefCont  
goto salir   

if @@error > 0 goto error                  
goto Salir  

Administrador:
set @select = 'select * from dbo.Tb_menu'
execute( @select)  

ListaRefCont:
set @select = 'select * from dbo.Tb_menu where parentid=''1'''
execute( @select)  

salir:                  
 return                  
                  
error:                  
 return  

GO


alter Procedure S_ListaUsuarios
as
	Select use_id,use_pwd , use_name,a.Cod_nvl,Desp_nvl , a.use_est as codsta,
	case use_est
		when '1' then 'ACTIVO'
		when '0' then 'INACTIVO'
	end as estado
	from TbUsuarios a,TbNivel b 
	where a.Cod_nvl = b.Cod_nvl order by a.Cod_nvl
Go	

Create proc S_ListaNiveles
as
	select Cod_nvl, Desp_nvl from dbo.TbNivel
Go	

-- S_InseUser 'RAGUIRRE'
-- S_InseUser 'grodriguez'
-- S_InseUser 'demosff','sdfds','sdfds','N001' 
alter proc S_InseUser
@Usuario varchar(20),@use_pwd varchar(20),@use_name varchar(100), @codp  varchar(4) 
as
BEGIN   
 BEGIN TRY
	BEGIN TRAN 
if exists (select * from  TbUsuarios where use_id = @Usuario  and use_Est='0' )
begin
	select 'Advertencia : El Usuario '''+@Usuario+''' existe , se encuentra bloqueado' ,'error'
end
else if exists (select * from  TbUsuarios where use_id = @Usuario  and use_Est='1' )
begin
	select 'Advertencia : El Usuario '''+@Usuario+''' ya se encontraba registrado' ,'error'
end
else 	
begin
	insert into TbUsuarios values (UPPER(@Usuario), @use_pwd ,UPPER(@use_name) , @codp ,'1' )
	--select  'El usuario Registrado en la Base de Datos','exito'
end
	COMMIT TRAN
 END TRY
 BEGIN CATCH 
	ROLLBACK TRAN
	select  'Error : No se ha podido Registrar en la Base de Datos.','error'
 END CATCH 
END
GO

alter Procedure [dbo].[S_Genera_Codigo]
 @nomtb varchar(50) ,@nro bigint output
as
declare @ano varchar(2)
 set @ano = LTRIM(  right(year(getdate()),2))
 set @nro = 1
 if not exists (select * from Tb_Cod where     tabla_genera = @nomtb  )
 begin
	insert into Tb_Cod values(@ano, @nro,@nomtb ) 
 end
 else 
 begin
	 if exists (select * from Tb_Cod where year_cod = @ano  and  tabla_genera = @nomtb    )
	 begin
		update  Tb_Cod set @nro = nro = nro + 1 , year_cod = @ano where  tabla_genera = @nomtb
	 end
	 else
	 begin
		update  Tb_Cod set @nro = nro =  1 , year_cod = @ano where  tabla_genera = @nomtb
	 end
 end
 GO
create FUNCTION  TRIM (@string VARCHAR(MAX))
RETURNS VARCHAR(MAX)
BEGIN
-- para SQL SERVER 2005
RETURN LTRIM(RTRIM(@string))
END

go

Create proc S_ListaCentos
as
 SELECT  Cod_Cent   , Nom_Centr   FROM  TbCent_Salud 
 GO
 
-- S_GrabaInspetor 'dmo','6220'
 alter Proc S_GrabaInspetor
 @nom_ins varchar(200),@codIn int
 as
 DECLARE  @Id_correlativo  int  ,@cod varchar(20)
 BEGIN  
 BEGIN TRY
	BEGIN TRAN 
	exec S_Genera_Codigo 'TbInspector',@Id_correlativo output
	set @cod = dbo.TRIM(  right(year(getdate()),2)) + right('00000000'+dbo.TRIM(@Id_correlativo),8)
		insert into TbInspector values(@cod, UPPER(@nom_ins) ,@codIn,'1')
		--select  'Datos Ingresados con Exito.','true'
		--DBCC CHECKIDENT ('dbo.tb_documentos', RESEED, 0); 
		COMMIT TRAN
 END TRY
 BEGIN CATCH 
	ROLLBACK TRAN
	--select ERROR_MESSAGE()
	select  'Error : No se ha podido Registrar los datos','error'
 END CATCH 
END
select right(year(getdate()),2)

delete from Tb_Cod
delete from TbInspector
select * from Tb_Cod
select*from TbInspector