package com.lc.sofa.flex.workspace.dao;

import java.util.List;
import java.util.Map;

import com.lc.sofa.flex.workspace.vo.DirectorieVO;
import com.lc.sofa.flex.workspace.vo.FileListVO;
import com.lc.sofa.flex.workspace.vo.WorkspaceVO;

public interface WorkspaceMapper {
	public List<DirectorieVO> getDirectories(Map<String, Object> paramMap);
	public List<FileListVO> getFileList(Map<String, Object> paramMap);

	
	public Integer insertDesignFileTree(List<WorkspaceVO> list);
	public Integer updateDesignFileTree(Map<String, Object> paramMap);
	
	public Integer deleteDesignFileTreeByIDAndModelType(Map<String, Object> paramMap);	
	public Integer deleteDesignFile(Map<String, Object> paramMap);
	public Integer deleteDesignFileTree(Map<String, Object> paramMap);
}
