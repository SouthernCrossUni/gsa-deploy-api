package scu.gsa.deployment;

import java.util.*;

import javax.mail.*;
import javax.mail.internet.*;

import java.util.ArrayList;

public class Mailer {
	private String toAddress;
	private String fromAddress;
	private String emailHost;
	private String emailBody;
	private Session emailSession;
	private String subject;
	
	private ArrayList<String> attachmentContentList;
	private ArrayList<String> attachmentNameList;
	
	private String attachmentContents;
	
	public String getRecipient() {
	return this.toAddress;
	}
	public void setRecipient(String address) {
	this.toAddress = address;
	}
	public String getAttachmentContents() {
	return this.attachmentContents;
	}
	
	public void propAttachmentContentList(Integer num) {
		this.attachmentContentList = new ArrayList<String>(num);
	}
	
	public void propAttachmentNameList(Integer num) {
		this.attachmentNameList = new ArrayList<String>(num);
	}
	
	public void addToAttachmentContentList(String content) {
		this.attachmentContentList.add(content);
	}
	
	public void addToAttachmentNameList(String name) {
		this.attachmentNameList.add(name);
	}
	
	public void setAttachmentContents(String content) {
	this.attachmentContents = content;
	}
	
	public void prepSubject(String subject) {
	this.subject = subject;
	}
	
	public String getSender() {
	return this.fromAddress;
	}
	public void setSender(String address) {
	this.fromAddress = address;
	}
	
	public void setEmailBody(String body) {
	this.emailBody = body;
	}
	
	public void setHost(String host) {
	this.emailHost = host;
	}
	
	public void setProps() {
		Properties prop = System.getProperties();
		//set the smtp host default to localhost
		prop.setProperty("mail.smtp.host", this.emailHost);
		//reseat the default session object
		this.emailSession = Session.getDefaultInstance(prop);
	}
	
	public void repopulateAttachments() {
		//attachmentContentList;
		//attachmentNameList;
		
		
	}
	
	public void sendEmail() {
	if (this.toAddress != null && !this.toAddress.isEmpty()
		&& this.fromAddress != null && !this.fromAddress.isEmpty()
		) {
				
			try {
				MimeMessage message = new MimeMessage(this.emailSession);
				message.setFrom(new InternetAddress(this.fromAddress));
				message.addRecipient(Message.RecipientType.TO, 
										new InternetAddress(this.toAddress));
				message.setSubject(this.subject);
				//message.setText(this.emailContents);
				
				 // Create the message part 
				 BodyPart messageBodyPart = new MimeBodyPart();

				 // Fill the message
				 messageBodyPart.setText(this.emailBody);
				 
				 // Create a multipart message
				 Multipart multipart = new MimeMultipart();

				 // Set text message part
				 multipart.addBodyPart(messageBodyPart);
				
				// add attachments
				 Integer index = 0;
				for (String attachmentName : this.attachmentNameList) {
					messageBodyPart = new MimeBodyPart();
					String filename = attachmentName;
					messageBodyPart.setText(this.attachmentContentList.get(index));
					messageBodyPart.setFileName(filename);
					multipart.addBodyPart(messageBodyPart);
					index++;
				}

				message.setContent(multipart);
				Transport.send(message);
				System.out.println("Sent message successfully....");
				
			} catch (MessagingException e) {
				e.printStackTrace();
			}
				
		} else {
			System.out.println("Empty email element found");
		}
		
	}
	
	public static void main(String [] args) 
	{	
		/*try {
			Mailer mailer = new Mailer();
			mailer.run(args);
		 }
		 catch (Exception e) {
			e.printStackTrace();
		 }*/
	}
	
	public void run(String args[]) throws Exception
	{
		Properties prop = System.getProperties();
		//set the smtp host default to localhost
		prop.setProperty("mail.smtp.host", this.emailHost);
		//get the default session object
		this.emailSession = Session.getDefaultInstance(prop);
	}
		
		
}