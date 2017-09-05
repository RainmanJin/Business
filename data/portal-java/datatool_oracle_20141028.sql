-- ��������ļ�Ŀ¼��
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

--����demo����
insert into SOFA_WORKSPACE_DESIGNFILETREE (id, name,type,Desighfileid,Parentid,userid)
values ('1', '���ڵ�1','d',null,0,'admin');
insert into SOFA_WORKSPACE_DESIGNFILETREE (id, name,type,Desighfileid,Parentid,userid)
values ('11', 'Ҷ�ӽڵ�1-1','f','100',1,'admin');
insert into SOFA_WORKSPACE_DESIGNFILETREE (id, name,type,Desighfileid,Parentid,userid)
values ('12', 'Ҷ�ӽڵ�1-2','f','100',1,'admin');
insert into SOFA_WORKSPACE_DESIGNFILETREE (id, name,type,Desighfileid,Parentid,userid)
values ('13', 'Ҷ�ӽڵ�1-3','f','100',1,'admin');
insert into SOFA_WORKSPACE_DESIGNFILETREE (id, name,type,Desighfileid,Parentid,userid)
values ('2', '���ڵ�2','d',null,0,'admin');
insert into SOFA_WORKSPACE_DESIGNFILETREE (id, name,type,Desighfileid,Parentid,userid)
values ('21', 'Ҷ�ӽڵ�2-1','f','100',2,'admin');
insert into SOFA_WORKSPACE_DESIGNFILETREE (id, name,type,Desighfileid,Parentid,userid)
values ('22', 'Ҷ�ӽڵ�2-2','f','100',2,'admin');
insert into SOFA_WORKSPACE_DESIGNFILETREE (id, name,type,Desighfileid,Parentid,userid)
values ('23', 'Ҷ�ӽڵ�2-3','f','100',2,'admin');
insert into SOFA_WORKSPACE_DESIGNFILETREE (id, name,type,Desighfileid,Parentid,userid)
values ('3', '���ڵ�3','d',null,0,'admin');
insert into SOFA_WORKSPACE_DESIGNFILETREE (id, name,type,Desighfileid,Parentid,userid)
values ('31', 'Ҷ�ӽڵ�3-1','f','100',3,'admin');
insert into SOFA_WORKSPACE_DESIGNFILETREE (id, name,type,Desighfileid,Parentid,userid)
values ('32', 'Ҷ�ӽڵ�3-2','f','100',3,'admin');
insert into SOFA_WORKSPACE_DESIGNFILETREE (id, name,type,Desighfileid,Parentid,userid)
values ('33', 'Ҷ�ӽڵ�3-3','f','100',3,'admin');
commit;
