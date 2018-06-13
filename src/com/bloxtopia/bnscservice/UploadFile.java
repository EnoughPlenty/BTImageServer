package com.bloxtopia.bnscservice;

import java.io.File;

import org.apache.http.HttpEntity;
import org.apache.http.HttpResponse;
import org.apache.http.HttpVersion;
import org.apache.http.client.HttpClient;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.entity.mime.MultipartEntity;
import org.apache.http.entity.mime.content.ContentBody;
import org.apache.http.entity.mime.content.FileBody;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.params.CoreProtocolPNames;
import org.apache.http.util.EntityUtils;

public class UploadFile {
	  public static void upload(String id) throws Exception {
    
	        static String secret = "Your secret key (for extra security)";
          static String siteUrl = "http://example.com/";
          static String diskPath = "C:\\Example\\";
	        String userHome=System.getProperty("user.home");
	        HttpClient httpclient = new DefaultHttpClient();
	        httpclient.getParams().setParameter(CoreProtocolPNames.PROTOCOL_VERSION, HttpVersion.HTTP_1_1);
	        HttpPost httppost = new HttpPost(siteUrl + "api/uploadcharacterthumbnail?uid=" + id + "&secret="+ secret +"&filename=" + id + ".png");
	        File file = new File(diskPath + "Screenshots/" + id + ".png");
	        MultipartEntity mpEntity = new MultipartEntity();
	        ContentBody contentFile = new FileBody(file);
	        mpEntity.addPart("theFile", contentFile);
	        httppost.setEntity(mpEntity);
	        System.out.println("executing request " + httppost.getRequestLine());
	        HttpResponse response = httpclient.execute(httppost);
	        HttpEntity resEntity = response.getEntity(); 
	 
	        if(!(response.getStatusLine().toString()).equals("HTTP/1.1 200 OK")){
	            // Successfully Uploaded
	        }
	        else{
	            System.err.println("Critical error! Upload failed.");
	        }
	        System.out.println(response.getStatusLine());
	        if (resEntity != null) {
	            System.out.println(EntityUtils.toString(resEntity));
	        }
	        if (resEntity != null) {
	            resEntity.consumeContent();
	        }
	        httpclient.getConnectionManager().shutdown();
	    }
	}

