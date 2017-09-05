package com.lc.sofa.flex.workspace.service;

import java.util.List;

import com.lc.sofa.core.framework.flex.service.IFlexService;
import com.lc.sofa.flex.workspace.vo.DeleteItemVO;
import com.lc.sofa.flex.workspace.vo.WorkspaceVO;

public interface WorkspaceService extends IFlexService {
	public String getDirectories(String userid,String modelname);
	public String saveDirectories(String json);
	public String getFileList(String userid,String directoryid);
	public String deleteItems(String userid,String modelname,List<DeleteItemVO> items);
	
	public Integer insertDesignFileTree(List<WorkspaceVO> list);
	public Integer updateDesignFileTree(String json);
	public Integer deleteDesignFileTreeByIDAndModelType(String userid,String modeltype);
}
