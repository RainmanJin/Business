package com.lc.sofa.flex.workspace.vo;


public class SofaBIUserInfo {
	private String id;
	private String userName;
	private String password;
	private String email;
	private String nickName;//（可以为空）
	private String realName;//（可以为空）
	private String signTime;
	
	/**
	 * @return the id
	 */
	public String getId() {
	
		return id;
	}
	
	/**
	 * @param id the id to set
	 */
	public void setId(String id) {
	
		this.id = id;
	}
	
	/**
	 * @return the userName
	 */
	public String getUserName() {
	
		return userName;
	}
	
	/**
	 * @param userName the userName to set
	 */
	public void setUserName(String userName) {
	
		this.userName = userName;
	}
	
	/**
	 * @return the password
	 */
	public String getPassword() {
	
		return password;
	}
	
	/**
	 * @param password the password to set
	 */
	public void setPassword(String password) {
	
		this.password = password;
	}
	
	/**
	 * @return the email
	 */
	public String getEmail() {
	
		return email;
	}
	
	/**
	 * @param email the email to set
	 */
	public void setEmail(String email) {
	
		this.email = email;
	}
	
	/**
	 * @return the nickName
	 */
	public String getNickName() {
	
		return nickName;
	}
	
	/**
	 * @param nickName the nickName to set
	 */
	public void setNickName(String nickName) {
	
		this.nickName = nickName;
	}
	
	
	/**
	 * @return the signTime
	 */
	public String getSignTime() {
	
		return signTime;
	}
	
	/**
	 * @param signTime the signTime to set
	 */
	public void setSignTime(String signTime) {
	
		this.signTime = signTime;
	}

	
	/**
	 * @return the realName
	 */
	public String getRealName() {
	
		return realName;
	}

	
	/**
	 * @param realName the realName to set
	 */
	public void setRealName(String realName) {
	
		this.realName = realName;
	}
	 
}
