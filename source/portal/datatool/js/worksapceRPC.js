function WorkSpaceRPC(){

    //web root
    this.webroot = "http://172.17.199.154:8088/sofa/flex-workspace/";
    //for zhaozhao
//    this.webroot = "http://172.16.252.80:8088/sofa/flex-workspace/";

    /**
     * 保存目录结构
     * @param userid  用户id
     * @param mname 模块名称
     * @param jsondata 要保存的数据 String类型
     * @param callback 成功时回调
     */
    this.saveDirectories = function (userid,mname,jsondata,callback)
    {
        $.ajax({
                type:"get",
                url:this.webroot+"workspace.ctrl?method=saveDirectories",
                crossDomain:true,
                data:{userid:userid,modelname:mname,data:jsondata},
                dataType:"jsonp",
                jsonp:"callbackparam",
                jsonpCallback:"success_jsonpCallback",
                success:callback,
                error:function(msg){
                    alert("error:"+msg);
                }

            }

        );
    };
    /**
     * 删除文件或文件夹
     * @param userid  用户id
     * @param mname 模块名称
     * @param jsondata 要保存的数据 String类型
     * @param callback 成功时回调
     */
    this.deleteItems = function (userid,mname,jsondata,callback)
    {
        $.ajax({
                type:"get",
                url:this.webroot+"workspace.ctrl?method=deleteItems",
                crossDomain:true,
                data:{userid:userid,modelname:mname,data:jsondata},
                dataType:"jsonp",
                jsonp:"callbackparam",
                jsonpCallback:"success_jsonpCallback",
                success:callback,
                error:function(msg){
                    alert("error:"+msg);
                }

            }

        );
    };

    /**
     * 获取文件列表
     * @param uid 用户id
     * @param did 文件夹id
     * @param callback 成功时回调
     */
    this.getFileList = function (uid,did,callback)
    {
        $.ajax({
                type:"get",
                url:this.webroot+"workspace.ctrl?method=getFileList",
                crossDomain:true,
                data:{userid:uid,directoryid:did},
                dataType:"jsonp",
                jsonp:"callbackparam",
                jsonpCallback:"success_jsonpCallback",
                success:callback,
                error:function(msg){
                    alert("error:"+msg);
                }

            }

        );
    };
    /**
     *  获取目录树
     * @param uid 用户id
     * @param mname 模块名称
     * @param callback 成功时回调
     */
    this.getTreeData = function (uid,mname,callback)
    {
        $.ajax({
                type:"get",
                url:this.webroot+"workspace.ctrl?method=getDirectories",
                crossDomain:true,

                data:{userid:uid,modelname:mname},
                dataType:"jsonp",
                jsonp:"callbackparam",
                jsonpCallback:"success_jsonpCallback",
                success:callback,
                error:function(msg){
                    alert("error:"+msg);
                }

            }

        );
    };
}