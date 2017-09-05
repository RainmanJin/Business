package com.lc.sofa.flex.workspace.dao;

import java.util.Map;

import com.lc.sofa.flex.workspace.vo.SofaBIUserInfo;

public interface LogginMapper {	
	
	public SofaBIUserInfo selectUserInfoById(String id);
	public SofaBIUserInfo selectUserInfoByName(String userName);
	public SofaBIUserInfo selectUserInfoByEmail(String email);
	public SofaBIUserInfo selectSofaBIUserNamePassword(Map<String, Object> paramMap);
	public SofaBIUserInfo selectSofaBIUserEmailPassword(Map<String, Object> paramMap);
	
	public Integer updateUserInfo(SofaBIUserInfo userInfo);
	
	public Integer insertUserInfo(SofaBIUserInfo userInfo);

	public Integer deleteUserInfo(String id);
}
