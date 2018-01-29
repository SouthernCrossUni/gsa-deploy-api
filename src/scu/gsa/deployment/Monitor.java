package scu.gsa.deployment;

public class Monitor {
	
	 private static final Object monitor = new Object();
	 private static boolean monitorState = false;
	 	 
	 public static void waitForThread() {
		  monitorState = true;
		  while (monitorState) {
		    synchronized (monitor) {
		      try {
		        monitor.wait(); // wait until notified
		      } catch (Exception e) {}
		    }
		  }
		}
	 
	 public static void unlockWaiter() {
		  synchronized (monitor) {
		    monitorState = false;
		    monitor.notifyAll(); // unlock again
		  }
		}
	 
}
