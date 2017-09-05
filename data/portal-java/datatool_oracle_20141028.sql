-- 创建设计文件目录表
create table SOFA_WORKSPACE_DESIGNFILETREE
(
  id           VARCHAR2(36) not null,
  name         VARCHAR2(200),
  type         VARCHAR2(10) not null,
  modeltype    VARCHAR2(200) not null,
  desighfileid VARCHAR2(36),
  parentid     VARCHAR2(36),
  userid       VARCHAR2(200) not null,
  open  VARCHAR2(10),
  primary key(id)
);
alter table SOFA_WORKSPACE_DESIGNFILETREE
  add constraint designFileId foreign key (DESIGHFILEID)
  references sofa_bi_dashboard_designfile (ID);

--插入demo数据
insert into SOFA_WORKSPACE_DESIGNFILETREE (id, name,type,Desighfileid,Parentid,userid)
values ('1', '父节点1','d',null,0,'admin');
insert into SOFA_WORKSPACE_DESIGNFILETREE (id, name,type,Desighfileid,Parentid,userid)
values ('11', '叶子节点1-1','f','100',1,'admin');
insert into SOFA_WORKSPACE_DESIGNFILETREE (id, name,type,Desighfileid,Parentid,userid)
values ('12', '叶子节点1-2','f','100',1,'admin');
insert into SOFA_WORKSPACE_DESIGNFILETREE (id, name,type,Desighfileid,Parentid,userid)
values ('13', '叶子节点1-3','f','100',1,'admin');
insert into SOFA_WORKSPACE_DESIGNFILETREE (id, name,type,Desighfileid,Parentid,userid)
values ('2', '父节点2','d',null,0,'admin');
insert into SOFA_WORKSPACE_DESIGNFILETREE (id, name,type,Desighfileid,Parentid,userid)
values ('21', '叶子节点2-1','f','100',2,'admin');
insert into SOFA_WORKSPACE_DESIGNFILETREE (id, name,type,Desighfileid,Parentid,userid)
values ('22', '叶子节点2-2','f','100',2,'admin');
insert into SOFA_WORKSPACE_DESIGNFILETREE (id, name,type,Desighfileid,Parentid,userid)
values ('23', '叶子节点2-3','f','100',2,'admin');
insert into SOFA_WORKSPACE_DESIGNFILETREE (id, name,type,Desighfileid,Parentid,userid)
values ('3', '父节点3','d',null,0,'admin');
insert into SOFA_WORKSPACE_DESIGNFILETREE (id, name,type,Desighfileid,Parentid,userid)
values ('31', '叶子节点3-1','f','100',3,'admin');
insert into SOFA_WORKSPACE_DESIGNFILETREE (id, name,type,Desighfileid,Parentid,userid)
values ('32', '叶子节点3-2','f','100',3,'admin');
insert into SOFA_WORKSPACE_DESIGNFILETREE (id, name,type,Desighfileid,Parentid,userid)
values ('33', '叶子节点3-3','f','100',3,'admin');
commit;
