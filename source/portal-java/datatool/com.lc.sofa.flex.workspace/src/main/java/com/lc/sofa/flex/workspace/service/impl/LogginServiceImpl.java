package com.lc.sofa.flex.workspace.service.impl;

import java.util.HashMap;
import java.util.List;
import java.util.Map;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import com.lc.sofa.core.framework.component.i18n.SofaI18n;
import com.lc.sofa.core.framework.flex.service.FlexService;
import com.lc.sofa.core.framework.util.json.JSONUtil;
import com.lc.sofa.flex.workspace.dao.LogginMapper;
import com.lc.sofa.flex.workspace.service.LogginService;
import com.lc.sofa.flex.workspace.vo.DirectorieVO;
import com.lc.sofa.flex.workspace.vo.SofaBIUserInfo;

@Service("logginService")
public class LogginServiceImpl extends FlexService implements LogginService {
	private SofaI18n sofaI18n = SofaI18n.getInstance();

	@Autowired
	private LogginMapper logginMapper;

	/**
	 * 注册新用户
	 * nickname（可以为空）
	 * realname（可以为空） {@inheritDoc} 
	 * 注册返回值：
	 * 成功                       ：同登录返回的一样
	 * 用户名已存在     ：2
	 * 邮箱已存在          ：3
	 * 注册时存入时间signtime，格式2014-7-8 18:45:26，返回插入的这条记录的所有字段的值的jso
	 * @see com.lc.sofa.flex.workspace.service.LogginService#signIn(java.lang.String, java.lang.String, java.lang.String,
	 *      java.lang.String, java.lang.String)
	 */
	public String signIn(String id,String username, String password, String email, String nickname, String realname) {
		//选择用户名
		SofaBIUserInfo sofaUserInfo = null;
		sofaUserInfo = logginMapper.selectUserInfoByName(username);
		//选择邮箱
		if(sofaUserInfo == null){
			sofaUserInfo = logginMapper.selectUserInfoByEmail(email);
		}else{
			return "2";//用户名已经存在
		}
		//注册
		if(sofaUserInfo == null){
			sofaUserInfo = new SofaBIUserInfo();
			sofaUserInfo.setId(id);
			sofaUserInfo.setUserName(username);
			sofaUserInfo.setPassword(password);
			sofaUserInfo.setEmail(email);
			sofaUserInfo.setNickName(nickname);
			sofaUserInfo.setRealName(realname);
			
			int insertNum = logginMapper.insertUserInfo(sofaUserInfo);
			if(insertNum>=1){
				//得到UserInfo
				sofaUserInfo = logginMapper.selectUserInfoByName(username);
				return JSONUtil.toJson(sofaUserInfo);//返回接送
			}else{
				return "插入用户信息失败";
			}
		}else{
			return "3";//邮箱已经存在
		}
	}

	/**
	 * 用户登录 {@inheritDoc} 登陆时只传username和password，username用户名或邮箱
	 * 
	 * @see com.lc.sofa.flex.workspace.service.LogginService#logIn(java.lang.String, java.lang.String)
	 *      登录返回值：
	 *      成功 :用户表这一条记录的所有字段值的json，如{
	 *      'id':3,'username':'lpx','password':'加密字符串','email':'lpx@xxx.xxx','nickname':'xxx','realname':'xxx','signtime':'2014-7-8
	 *      18:45:26'}
	 *      用户名不存在: 2
	 *      密码错误 : 3
	 */
	public String logIn(String username, String password) {
		Map<String, Object> paramMap = new HashMap<String, Object>();
		paramMap.put("userName", username);
		paramMap.put("password", password);
		//根据用户名查询
		SofaBIUserInfo userInfo = null;
		userInfo = logginMapper.selectUserInfoByName(username);
		
		if(userInfo != null){
			//有此用户,验证密码
			userInfo = logginMapper.selectSofaBIUserNamePassword(paramMap);
			if(userInfo!=null){
				return JSONUtil.toJson(userInfo);//成功
			}else{
				return "3" ;//密码错误
			}			
		}else{
			//无此用户,根据邮箱
			userInfo = logginMapper.selectUserInfoByEmail(username);
			if(userInfo != null){
				//有此邮箱，验证密码
				userInfo = logginMapper.selectSofaBIUserEmailPassword(paramMap);
				if(userInfo!=null){
					return JSONUtil.toJson(userInfo);
				}else{
					return "3" ;//密码错误
				}
			}else{
				return "2";//无此用户
			}
		}
	}

	/**
	 * 获得用户信息 {@inheritDoc} 返回值：同登录注册的一样，用户表这一条记录的所有字段值的json，如{
	 * 'id':3,'username':'lpx','password':'加密字符串','email':'lpx@xxx.xxx','nickname':'xxx','realname':'xxx','signtime':'2014-7-8
	 * 18:45:26'}
	 * 
	 * @see com.lc.sofa.flex.workspace.service.LogginService#getUserInfoByID(java.lang.String)
	 */
	public String getUserInfoByID(String id) {
		SofaBIUserInfo sofaUserInfo = logginMapper.selectUserInfoById(id);
		if(sofaUserInfo!=null){
			return JSONUtil.toJson(sofaUserInfo);
		}else{
			return "";
		}
	}

	public String updateUserInfo(String id,String username,String password,String email, String nickname,String realname){
		SofaBIUserInfo sofaUserInfo = new SofaBIUserInfo();
		sofaUserInfo.setId(id);
		sofaUserInfo.setUserName(username);
		sofaUserInfo.setPassword(password);
		sofaUserInfo.setEmail(email);
		sofaUserInfo.setNickName(nickname);
		sofaUserInfo.setRealName(realname);
		
		int insertNum = logginMapper.updateUserInfo(sofaUserInfo);
		if(insertNum>=1){
			return "success";
		}
		return "no user";
	}
	
	public String deleteUserInfo(String id){
		int insertNum = logginMapper.deleteUserInfo(id);
		if(insertNum>=1){
			return "success";
		}
		return "no user";
	}
}
