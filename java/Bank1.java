import java.awt.*;  
    import java.awt.event.*;  
     import javax.swing.*;  
    public class Bank1 extends JFrame {  
        
     private JLabel l1;  
     private JLabel l2;  
     private JTextField t1;  
     private JPasswordField p1;  
    private JButton b1;  
        
     public Bank1()  
     {  
        super("Bank System");  
            
         Container container = getContentPane();  
         container.setLayout(new FlowLayout());  
            
            
         l1=new JLabel(" ID :- ");  
         container.add(l1);  
         t1=new JTextField(25);  
         container.add(t1);  
         l2=new JLabel(" Password :- ");  
         container.add(l2);  
         p1=new JPasswordField(25);  
         container.add(p1);  
         b1=new JButton("Enter");  
         container.add(b1);  
            
         ButtonHandler handler = new ButtonHandler();  
         b1.addActionListener(handler);  
         setSize(400,150);  
         setVisible(true);  
     }  
     public static void main (String args[])  
     {  
       Bank1 application = new Bank1();  
    application.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);  
     }  
        
    private class ButtonHandler implements ActionListener {
        public void actionPerformed(ActionEvent event) {
            JFrame secondFrame = new JFrame("Second Frame");
            secondFrame.setSize(600, 500);
            secondFrame.setVisible(true);
            dispose();
        }
    }  
          }  