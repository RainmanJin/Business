package com.lc.sofa.flex.workspace.controller;

import javax.servlet.http.HttpServletRequest;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.ResponseBody;

import com.lc.sofa.core.framework.basis.log.RecordLog;
import com.lc.sofa.flex.workspace.service.LogginService;

@Controller("/loggin.ctrl")
public class LogginController{
	
	@Autowired
	private LogginService logginService;
	
	@ResponseBody
	@RequestMapping(params = "method=signIn")
//	@RecordLog(functionName = "工作空间", operationName = "注册新用户")
	public String signIn(HttpServletRequest request){
		String id = request.getParameter("id");
		String username = request.getParameter("username");
		String password = request.getParameter("password");
		String email = request.getParameter("email");
		String nickname = request.getParameter("nickname");
		String realname = request.getParameter("realname");
		
		if(id == null) return "errer";
		if(username == null) return "errer";
		if(password == null) return "errer";
		if(email == null) return "errer";
		if(nickname == null) nickname = "";
		if(realname == null) realname = "";
		return logginService.signIn(id,username, password, email, nickname, realname);
	}
	
	@ResponseBody
	@RequestMapping(params = "method=logIn")
//	@RecordLog(functionName = "工作空间", operationName = "登陆，检测是否是已有用户")
	public String logIn(HttpServletRequest request){	
		String username = request.getParameter("username");
		String password = request.getParameter("password");
		return logginService.logIn(username, password);
	}
	
	@ResponseBody
	@RequestMapping(params = "method=getUserByID")
//	@RecordLog(functionName = "工作空间", operationName = "根据用户id获得用户信息")
	public String getUserByID(HttpServletRequest request){	
		String id = request.getParameter("id");
		return logginService.getUserInfoByID(id);
	}
	
	@ResponseBody
	@RequestMapping(params = "method=updateUserByID")
//	@RecordLog(functionName = "工作空间", operationName = "根据用户id更新用户信息")
	public String updateUserByID(HttpServletRequest request){
		String id = request.getParameter("id");
		String username = request.getParameter("username");
		String password = request.getParameter("password");
		String email = request.getParameter("email");
		String nickname = request.getParameter("nickname");
		String realname = request.getParameter("realname");
		
		if(id == null) return "errer";
		if(username == null) return "errer";
		if(password == null) return "errer";
		if(email == null) return "errer";
		if(nickname == null) nickname = "";
		if(realname == null) realname = "";
		return logginService.updateUserInfo(id,username, password, email, nickname, realname);
	}
	
	@ResponseBody
	@RequestMapping(params = "method=deleteUserByID")
//	@RecordLog(functionName = "工作空间", operationName = "根据用户id删除用户信息")
	public String deleteUserByID(HttpServletRequest request){	
		String id = request.getParameter("id");
		return logginService.deleteUserInfo(id);
	}
}

