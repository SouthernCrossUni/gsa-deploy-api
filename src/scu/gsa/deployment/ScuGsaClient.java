package scu.gsa.deployment;

import com.google.enterprise.apis.client.GsaClient;
import com.google.gdata.util.AuthenticationException;

public class ScuGsaClient {	
	public GsaClient scuClient;
	
	public ScuGsaClient() {
		
		String admPassword = System.getenv("adm.password");
		String gsaHost = System.getenv("gsa.host");
		try {
			final GsaClient myClient = new GsaClient(gsaHost, 8000, "admin", admPassword);
			scuClient = myClient;
		} catch (AuthenticationException e) {
		  	// Handle the error
			System.err.println(e);
			System.exit(1);
		}
	}

}