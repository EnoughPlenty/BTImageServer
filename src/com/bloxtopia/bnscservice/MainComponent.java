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
import java.io.BufferedInputStream;
import java.io.BufferedReader;
import java.io.BufferedWriter;
import java.io.File;
import java.io.FileInputStream;
import java.io.FileOutputStream;
import java.io.IOException;
import java.io.InputStreamReader;
import java.io.PrintWriter;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;
import java.nio.file.Files;
import java.nio.file.Path;
import java.nio.file.Paths;
import java.util.ArrayList;
import java.util.Arrays;
import java.util.LinkedList;
import java.util.zip.GZIPOutputStream;
import java.awt.AWTException;
import java.awt.Color;
import java.awt.Graphics2D;
import java.awt.Image;
import java.awt.MouseInfo;
import java.awt.Rectangle;
import java.awt.Robot;
import java.awt.Toolkit;
import java.awt.event.InputEvent;
import java.awt.image.BufferedImage;
import java.awt.image.FilteredImageSource;
import java.awt.image.ImageFilter;
import java.awt.image.ImageProducer;
import java.awt.image.RGBImageFilter;
import java.awt.image.WritableRaster;
import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.io.OutputStream;
import java.io.OutputStreamWriter;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.ProtocolException;
import java.net.URL;
import javax.imageio.ImageIO;
import javax.swing.JOptionPane;
import java.awt.Rectangle;
import java.awt.Robot;
import java.awt.Toolkit;
import java.awt.image.BufferedImage;
import java.io.*;
import javax.imageio.*;
import java.util.logging.Logger;
import java.io.Console;

public class MainComponent {
	
	/*
	BNSCService created by willemsteller.
	For any questions you can join the Bloxtopia Discord server
	https://discord.gg/ahQJE3R
	*/
	
	public static boolean isServiceRunning = true;
	
	public static String baseUrl = "http://example.com/";
	public static String basePath = "C:\\Example\\";
	
	public static void main ( String [] arguments )
    {		
		click(755, 393, false);
		while (isServiceRunning = true) {
			try {
	        	URL link = new URL(baseUrl + "api/thumbnailchangerequests");
	        	HttpURLConnection conn = (HttpURLConnection)link.openConnection();
	        	conn.setRequestMethod("GET");
			    BufferedReader rd = new BufferedReader(new InputStreamReader(conn.getInputStream()));
			    String data = rd.readLine();
			    String[] info = data.split(";");
			    System.out.println("Raw data: " + data);
			    System.out.println("Array: " + Arrays.toString(info));
			    String id = info[0];
			    String type = info[1];
			    int idInt = Integer.parseInt(id);
			    rd.close();
			    conn.disconnect();
			    if (idInt != 0) {
			    	System.out.println("Thumbnail generation started...");
			    	ProcessBuilder pb = new ProcessBuilder();
			    	LinkedList<String> list = new LinkedList<String>();
			    	list.add(basePath + "BNSCService\\ImageServer.exe");
			    	list.add("-script");
			    	list.add("print(\"dofile('"+ baseUrl + "api/thumb?uid="+ id +"&type="+ type +"')\")");
					pb.command(list);
					Process process = pb.start();
					Thread.sleep(4000);
					click(0,0,false);
					Thread.sleep(10);
					click(238 , 33, true);
					Thread.sleep(500);
					click(341 , 213, true);
					Thread.sleep(100);
					click (0,0,false);
					click (35,132,false);
					if (type == "hat") {
						Robot robot1 = null;
						robot1.mouseWheel(200);
					}
					try {
						Thread.sleep(200);
						Robot awt_robot = new Robot();
						BufferedImage screen = awt_robot.createScreenCapture(new Rectangle(Toolkit.getDefaultToolkit().getScreenSize()));
						BufferedImage image = new Robot().createScreenCapture(new Rectangle(Toolkit.getDefaultToolkit().getScreenSize()));
						Image Entire_Screen = makeColorTransparent(screen, new Color(0,255,1));
						
						ImageIO.write(toBufferedImage(Entire_Screen), "PNG", new File(basePath + "Screenshots/"+ id +".png"));
						process.destroy();
						
						Path path = Paths.get(basePath + "Screenshots/"+ id +".png");
						byte[] _data = Files.readAllBytes(path);
						
						UploadFile.upload(id, type);
						URL finish = new URL(baseUrl + "api/thumbnailchangerequests?done=1");
			        	HttpURLConnection finishConn = (HttpURLConnection)finish.openConnection();
			        	finishConn.setRequestMethod("POST");
			        	BufferedReader frd = new BufferedReader(new InputStreamReader(finishConn.getInputStream()));
					    String fid = frd.readLine();
						Thread.sleep(1000);
						System.gc();
						
						
					} catch (Exception e) {
						// TODO Auto-generated catch block
						e.printStackTrace();
					}
					Thread.sleep(1000);
					process.destroy();
					click(238 , 33, false);
					System.gc();
			    } else {
			    	System.out.println("No thumbnail change requests! Waiting 1 second.");
			    	Thread.sleep(1000);
			    }
	        }
	        catch (MalformedURLException e) {
	        	e.printStackTrace();
	        } catch (IOException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			} catch (InterruptedException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			}
	    }
	}
        
	
	public static void click(int x, int y, boolean click){
	//Created by andreja6
	    Robot bot;
		try {
			bot = new Robot();
			bot.mouseMove(x, y);
			if(click == true)
			{
		    bot.mousePress(InputEvent.BUTTON1_MASK);
		    bot.mouseRelease(InputEvent.BUTTON1_MASK);
			}
		} catch (AWTException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
	    
	}
	public static void scrollout(int x, int y){
	//Created by andreja6
	    Robot bot;
		try {
			bot = new Robot();
			bot.mouseMove(x, y);
			for(int i = 0; i < 100; i++)
			bot.mouseWheel(200);
			
			
		    bot.mousePress(InputEvent.BUTTON1_MASK);
		    bot.mouseRelease(InputEvent.BUTTON1_MASK);
			
		} catch (AWTException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
	    
	}
	
	public static Image makeColorTransparent(BufferedImage im, final Color color) {
	//Created by andreja6
        ImageFilter filter = new RGBImageFilter() {

            // the color we are looking for... Alpha bits are set to opaque
            public int markerRGB = color.getRGB() | 0xFF000000;

            public final int filterRGB(int x, int y, int rgb) {
                if ((rgb | 0xFF000000) == markerRGB) {
                    // Mark the alpha bits as zero - transparent
                    return 0x00FFFFFF & rgb;
                } else {
                    // nothing to do
                    return rgb;
                }
            }
        };

        ImageProducer ip = new FilteredImageSource(im.getSource(), filter);
        return Toolkit.getDefaultToolkit().createImage(ip);
    }
	
	public static BufferedImage toBufferedImage(Image img)
	{
	    if (img instanceof BufferedImage)
	    {
	        return (BufferedImage) img;
	    }

	    // Create a buffered image with transparency
	    BufferedImage bimage = new BufferedImage(img.getWidth(null), img.getHeight(null), BufferedImage.TYPE_INT_ARGB);

	    // Draw the image on to the buffered image
	    Graphics2D bGr = bimage.createGraphics();
	    bGr.drawImage(img, 0, 0, null);
	    bGr.dispose();

	    // Return the buffered image
	    return bimage;
	}
}
