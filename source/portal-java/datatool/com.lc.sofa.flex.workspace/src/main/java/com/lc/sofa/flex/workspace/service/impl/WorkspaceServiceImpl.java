package com.lc.sofa.flex.workspace.service.impl;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import com.lc.sofa.core.framework.component.i18n.SofaI18n;
import com.lc.sofa.core.framework.flex.service.FlexService;
import com.lc.sofa.core.framework.util.json.JSONUtil;
import com.lc.sofa.flex.workspace.dao.WorkspaceMapper;
import com.lc.sofa.flex.workspace.service.WorkspaceService;
import com.lc.sofa.flex.workspace.vo.DeleteItemVO;
import com.lc.sofa.flex.workspace.vo.DirectorieVO;
import com.lc.sofa.flex.workspace.vo.FileListVO;
import com.lc.sofa.flex.workspace.vo.WorkspaceVO;

@Service("workspaceService")
public class WorkspaceServiceImpl extends FlexService implements WorkspaceService {

	private SofaI18n sofaI18n = SofaI18n.getInstance();

	@Autowired
	private WorkspaceMapper workspaceMapper;

	public String getDirectories(String userid, String modelname) {
		Map<String, Object> paramMap = new HashMap<String, Object>();
		paramMap.put("userid", userid);
		paramMap.put("modelname", modelname);
		List<DirectorieVO> result = this.workspaceMapper.getDirectories(paramMap);		
		String json = JSONUtil.toJson(result);
		return json;
	//	return "[{\"id\":1,\"pId\":0,\"name\":\"父节点1\",\"open\":true},{\"id\":11,\"pId\":1,\"name\":\"叶子节点1-1\"},{\"id\":12,\"pId\":1,\"name\":\"叶子节点1-2\"},{\"id\":13,\"pId\":1,\"name\":\"叶子节点1-3\"},{\"id\":2,\"pId\":0,\"name\":\"父节点2\",\"open\":true},{\"id\":21,\"pId\":2,\"name\":\"叶子节点2-1\"},{\"id\":22,\"pId\":2,\"name\":\"叶子节点2-2\"},{\"id\":23,\"pId\":2,\"name\":\"叶子节点2-3\"},{\"id\":3,\"pId\":0,\"name\":\"父节点3\",\"open\":true},{\"id\":31,\"pId\":3,\"name\":\"叶子节点3-1\"},{\"id\":32,\"pId\":3,\"name\":\"叶子节点3-2\"},{\"id\":33,\"pId\":3,\"name\":\"叶子节点3-3\"}]";
	}

	public String getFileList(String userid, String directoryid) {
		Map<String, Object> paramMap = new HashMap<String, Object>();
		paramMap.put("userid", userid);
		paramMap.put("directoryid", directoryid);
		List<FileListVO> result = this.workspaceMapper.getFileList(paramMap);	
		String json = JSONUtil.toJson(result);
		return json;
		//return "[{id:1,name:\"文件1\",type:\"f\"},{id:1,name:\"文件2\",type:\"f\"},{id:1,name:\"文件3\",type:\"f\"},	{id:1,name:\"文件夹1\",type:\"d\"},	{id:1,name:\"文件夹2\",type:\"d\"}]";
	}

	public Integer insertDesignFileTree(List<WorkspaceVO> list) {
		Integer result = this.workspaceMapper.insertDesignFileTree(list);
		return result;
	}

	public Integer updateDesignFileTree(String json) {

		// TODO Auto-generated method stub
		return null;
	}
	
	/**
	 * 根据用户id和模块名删除目录
	 * {@inheritDoc}
	 * @see com.lc.sofa.flex.workspace.service.WorkspaceService#deleteDesignFileTreeByIDAndModelType(java.lang.String, java.lang.String)
	 */
	public Integer deleteDesignFileTreeByIDAndModelType(String userid,String modeltype){
		Map<String, Object> paramMap = new HashMap<String, Object>();
		paramMap.put("userid", userid);
		paramMap.put("modelType", modeltype);
		Integer result = this.workspaceMapper.deleteDesignFileTreeByIDAndModelType(paramMap);
		return result;
	}
	
	public String saveDirectories(String json) {

		// TODO Auto-generated method stub
		return "true";
	}

	public String deleteItems(String userid, String modelname, List<DeleteItemVO> items) {
		List<String> directoryIds = new ArrayList<String>();
		List<String> fileIds = new ArrayList<String>();
		Integer deleteFileResult  = 0;
		Integer deleteDirectoryResult =0;
		//删选出文件和目录
		for(DeleteItemVO item:items){
			if(item.getType().equalsIgnoreCase("d")){//是目录
				directoryIds.add(item.getId());
			}else{//是文件，直接上出文件表中数据，目录表中数据会自动级联删除
				fileIds.add(item.getId());
			}
		}
		//删除目录表中的目录
		if(directoryIds.size()>0){
			Map<String, Object> paramMap = new HashMap<String, Object>();
			paramMap.put("userid", userid);
			paramMap.put("modelType", modelname);
			paramMap.put("type", "d");		
			paramMap.put("ids", directoryIds);		
		    deleteDirectoryResult = this.workspaceMapper.deleteDesignFileTree(paramMap);			
		}
		
		//删除文件表中的文件(oracle目前会级联删除文件夹表中对应的文件记录）
		if(fileIds.size()>0){
			Map<String, Object> fileParamMap = new HashMap<String, Object>();
			fileParamMap.put("userid", userid);
			fileParamMap.put("ids", fileIds);
			deleteFileResult = workspaceMapper.deleteDesignFile(fileParamMap);
		}
		
		//return "deleteDirectoryResult:"+deleteDirectoryResult+"  deleteFileResult:"+deleteFileResult;
		return "true";
	}

}
















