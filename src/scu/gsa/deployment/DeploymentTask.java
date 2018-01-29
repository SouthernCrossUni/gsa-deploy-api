package scu.gsa.deployment;

public interface DeploymentTask {
	public static class DeploymentException extends Exception {
		private static final long serialVersionUID = -8657431717104297311L;

		public DeploymentException(String message) {
	        super(message);
	    }
	}
}
