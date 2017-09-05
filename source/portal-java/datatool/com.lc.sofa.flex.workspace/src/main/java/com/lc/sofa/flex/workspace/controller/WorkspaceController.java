package com.lc.sofa.flex.workspace.controller;

import java.io.UnsupportedEncodingException;
import java.net.URLDecoder;
import java.util.ArrayList;
import java.util.List;

import javax.servlet.http.HttpServletRequest;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.ResponseBody;

import com.lc.sofa.core.framework.basis.log.ParameterLog;
import com.lc.sofa.core.framework.util.json.JSONUtil;
import com.lc.sofa.flex.workspace.service.WorkspaceService;
import com.lc.sofa.flex.workspace.vo.DeleteItemVO;
import com.lc.sofa.flex.workspace.vo.WorkspaceVO;

@Controller("/workspace.ctrl")
public class WorkspaceController {

	@Autowired
	private WorkspaceService workspaceService;

	@ResponseBody
	@RequestMapping(params = "method=getDirectories")
//	@RecordLog(functionName = "工作空间", operationName = "获得用户设计文件目录")
	public String getDirectories(@ParameterLog(paramName = "userid") String userid,
								 @ParameterLog(paramName = "modelname") String modelname, HttpServletRequest request) {
		String parameter = request.getParameter("callbackparam");// 跨域问题，使用jquery的jsonp解决，返回方法样式字符串
		if(userid != null && modelname != null){
			
			String json = workspaceService.getDirectories(userid, modelname);

			if (parameter != null) {
				return parameter + "(" + json + ")";
			}
			return json;
		}
		return parameter + "(\"userid或者modelname为空\")";
	}
	
	@ResponseBody
	@RequestMapping(params = "method=saveDirectories")
//	@RecordLog(functionName = "工作空间", operationName = "保存用户设计文件目录")
	public String saveDirectories(@ParameterLog(paramName = "userid") String userid,
	                              @ParameterLog(paramName = "modelname") String modelname,
	                              @ParameterLog(paramName = "data") String data, HttpServletRequest request) {
		String parameter = request.getParameter("callbackparam");// 跨域问题，使用jquery的jsonp解决，返回方法样式字符串	
		if(userid != null && modelname != null){
			String data1 = "";
			try {
				data1 = URLDecoder.decode(data, "UTF-8");
			} catch (UnsupportedEncodingException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			}
			List<WorkspaceVO> list = (List<WorkspaceVO>)JSONUtil.toListWithNumStr2Mum(data1, WorkspaceVO.class);
				
			// First批量删除当前用户当前model的所有目录列表
			Integer deleteResult = workspaceService.deleteDesignFileTreeByIDAndModelType(userid, modelname);
			// Second批量插入当前用户当前model的所有列表
					
			for(int i=0,len=list.size();i<len;i++){
				if(list.get(i).getpId()==null) list.get(i).setpId("");
				list.get(i).setDesignFileId("");//都是目录，id为空
				list.get(i).setType("d");//都是目录
				list.get(i).setUserId(userid);
				list.get(i).setModelType(modelname);
				if(list.get(i).getOpen()==null){
					list.get(i).setOpen("false");
				}
			}
			Integer insertResult = workspaceService.insertDesignFileTree(list);
						
			if (parameter != null) {
				if (deleteResult > 0 && insertResult > 0) {
					return parameter + "(true)";
				}
				return parameter + "(false)";
			}else{
				return "false";
			}	
		}
		return parameter + "(\"userid或者directoryid为空\")";	
	}

	@ResponseBody
	@RequestMapping(params = "method=getFileList")
//	@RecordLog(functionName = "工作空间", operationName = "获得用户所点击设计文件或目录的下级文件和目录")
	public String getFileList(@ParameterLog(paramName = "userid") String userid,
							  @ParameterLog(paramName = "directoryid") String directoryid, HttpServletRequest request) {
		String parameter = request.getParameter("callbackparam");// 跨域问题，使用jquery的jsonp解决，返回方法样式字符串
		if(userid != null && directoryid != null){			
			String json = workspaceService.getFileList(userid, directoryid);
			if (parameter != null) {
				return parameter + "(" + json + ")";
			}
			return json;
		}
		return parameter + "(\"userid或者directoryid为空\")";
	}
	
	@ResponseBody
	@RequestMapping(params = "method=deleteItems")
//	@RecordLog(functionName = "工作空间", operationName = "获得用户所点击设计文件或目录的下级文件和目录")
	public String deleteItems(@ParameterLog(paramName = "userid") String userid,
							  @ParameterLog(paramName = "modelname") String modelname,
							  @ParameterLog(paramName = "data") String data,HttpServletRequest request) {
		String parameter = request.getParameter("callbackparam");// 跨域问题，使用jquery的jsonp解决，返回方法样式字符串
		if(userid != null && modelname != null){
			String data1 = "";
			try {
				data1 = URLDecoder.decode(data, "UTF-8");
			} catch (UnsupportedEncodingException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			}
			List<DeleteItemVO> list = (List<DeleteItemVO>)JSONUtil.toListWithNumStr2Mum(data1, DeleteItemVO.class);
					
			String json = workspaceService.deleteItems(userid, modelname, list);
			if (parameter != null) {
				return parameter + "(" + json + ")";
			}
			return json;
		}
		return parameter + "(\"userid或者modelname为空\")";
	}
}
