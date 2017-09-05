package com.lc.sofa.flex.workspace.service;

import com.lc.sofa.core.framework.flex.service.IFlexService;


public interface LogginService extends IFlexService{
	public String signIn(String id,String username,String password,String email, String nickname,String realname);
	public String logIn(String username,String password);
	public String getUserInfoByID(String id);
	public String updateUserInfo(String id,String username,String password,String email, String nickname,String realname);
	public String deleteUserInfo(String id);
}
