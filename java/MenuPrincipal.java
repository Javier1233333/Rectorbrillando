import javax.swing.*;
import javax.swing.border.EmptyBorder;

import java.awt.*;
import java.awt.event.*;





public class MenuPrincipal extends JFrame {
	
	private static final long serialVersionUID = 1L;
	private JPanel panelprincipal;
	JScrollPane scrollPane;
	
	public static void main(String[] args) {
		MenuPrincipal frame = new MenuPrincipal();
	    frame.setVisible(true);
	    frame.setLocation(10, 10);
	    }

	
	public MenuPrincipal() {
		setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		scrollPane= new JScrollPane();
		setBounds(100, 100, 800, 660);

		
		panelprincipal = new JPanel();
		setBounds(100, 100, 780, 607);
		panelprincipal.setBackground(new Color(72, 209, 204));
		panelprincipal.setBorder(new EmptyBorder(5, 5, 5, 5));
        
		
		
		
		
		
		
		JButton BotonIntroduccion = new JButton("Contenido 1");
		BotonIntroduccion.setForeground(new Color(0, 0, 0));
		BotonIntroduccion.setEnabled(false);
		BotonIntroduccion.setBackground(new Color(60, 179, 113));
		BotonIntroduccion.setFont(new Font("Rockwell", Font.PLAIN, 30));
		BotonIntroduccion.setBounds(30, 251, 209, 56);
		panelprincipal.setLayout(null);
		BotonIntroduccion.setVerticalAlignment(SwingConstants.TOP);
		
		JButton Boton1 = new JButton("Prueba");
		Boton1.setIcon(new ImageIcon("C:\\Users\\javie\\Downloads\\Introducción al lenguaje (220 × 69 px) (4).png"));
		Boton1.setForeground(new Color(220, 20, 60));
		Boton1.setBounds(30, 60, 209, 62);
		
		JButton btnNewButton_1 = new JButton("New button");
		btnNewButton_1.setIcon(new ImageIcon("C:\\Users\\javie\\Downloads\\Introducción al lenguaje (220 × 69 px) (2).png"));
		btnNewButton_1.setSelectedIcon(new ImageIcon("C:\\Users\\javie\\Downloads\\Introducción al lenguaje (220 × 69 px) (4).png"));
		btnNewButton_1.setBounds(278, 60, 209, 62);
		
		JButton btnNewButton_1_1 = new JButton("New button");
		btnNewButton_1_1.setBackground(Color.GRAY);
		btnNewButton_1_1.setIcon(new ImageIcon("C:\\Users\\javie\\Downloads\\Introducción al lenguaje (220 × 69 px) (3).png"));
		btnNewButton_1_1.setBounds(528, 60, 209, 62);
		
		JButton btnNewButton_1_2 = new JButton("New button");
		btnNewButton_1_2.setBounds(278, 450, 209, 62);
		
		
		JButton btnNewButton_1_3 = new JButton("New button");
		btnNewButton_1_3.setBounds(528, 450, 209, 62);
		
		JButton btnNewButton_1_4 = new JButton("New button");
		btnNewButton_1_4.setBounds(30, 450, 209, 62);
		
		JButton btnNewButton_1_5 = new JButton("New button");
		btnNewButton_1_5.setBounds(278, 249, 209, 62);
		
		JButton btnNewButton_1_6 = new JButton("New button");
		btnNewButton_1_6.setBounds(528, 249, 209, 62);
		
		
		JButton btnNewButton_1_7 = new JButton("New button");
		btnNewButton_1_7.setBounds(628, 349, 209, 62);
		
		JButton btnNewButton_1_8 = new JButton("New button");
		btnNewButton_1_8.setBounds(678, 449, 209, 62);
		
		JButton btnNewButton_1_9= new JButton("New button");
		btnNewButton_1_7.setBounds(678, 449, 209, 62);
		
		
		JLabel lblNewLabel = new JLabel("");
		lblNewLabel.setEnabled(false);
		lblNewLabel.setBackground(new Color(255, 0, 255));
		lblNewLabel.setFont(new Font("Segoe UI Historic", Font.BOLD, 27));
		lblNewLabel.setHorizontalAlignment(SwingConstants.CENTER);
		
		JLabel lblNewLabel_1 = new JLabel("CURSOVI");
		lblNewLabel_1.setFont(new Font("MS Reference Sans Serif", Font.ITALIC, 24));
		lblNewLabel_1.setHorizontalAlignment(SwingConstants.CENTER);
		lblNewLabel_1.setBackground(Color.MAGENTA);
		lblNewLabel_1.setOpaque(true);
		lblNewLabel_1.setBounds(0, 0, 766, 49);
		
		scrollPane.setViewportView(panelprincipal);
		setContentPane(panelprincipal);
		panelprincipal.add(btnNewButton_1_1);
		panelprincipal.add(BotonIntroduccion);
		panelprincipal.add(Boton1);
		panelprincipal.add(btnNewButton_1);
		panelprincipal.add(btnNewButton_1_2);
		panelprincipal.add(btnNewButton_1_3);
		panelprincipal.add(btnNewButton_1_4);
		panelprincipal.add(btnNewButton_1_5);
		panelprincipal.add(btnNewButton_1_6);
		panelprincipal.add(btnNewButton_1_7);
		panelprincipal.add(btnNewButton_1_8);
		panelprincipal.add(btnNewButton_1_9);
		panelprincipal.add(lblNewLabel);
		panelprincipal.add(lblNewLabel_1);

		
		class Home2 extends JFrame
		{


			private JPanel PanelMenu2;


			private static final long serialVersionUID = 1L;

			public Home2() {
				setBackground(SystemColor.desktop);
				setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
				setBounds(100, 100, 506, 384);
				PanelMenu2 = new JPanel();
				PanelMenu2.setBackground(SystemColor.activeCaption);
				PanelMenu2.setBorder(new EmptyBorder(5, 5, 5, 5));
				PanelMenu2.setLayout(null);

				JButton bTexto = new JButton("Texto");
				bTexto.setBounds(70, 85, 89, 23);
				
				JButton bCodigo = new JButton("Codigo");
				bCodigo.setBounds(206, 85, 89, 23);
				
				JButton bVideo = new JButton("video");
				bVideo.setBounds(337, 85, 89, 23);
				
				JButton bRegresar = new JButton("Regresar");
				bRegresar.setBounds(337, 261, 89, 23);
				
				
				
				setContentPane(PanelMenu2);
				PanelMenu2.add(bTexto);
				PanelMenu2.add(bCodigo);
				PanelMenu2.add(bVideo);
				PanelMenu2.add(bRegresar);
				
				
				
				
				bRegresar.addActionListener(new ActionListener() {
					public void actionPerformed(ActionEvent e) {
						MenuPrincipal frame = new MenuPrincipal();
					    frame.setVisible(true);
					    frame.setLocation(10, 10);	
					    dispose();
					}
					
				});
			}
		}
		
	Boton1.addActionListener(new ActionListener() {
		public void actionPerformed(ActionEvent e) {
			JFrame home2 = new Home2();	
			home2.setVisible(true);
			home2.setSize(520, 510);
			home2.setLocation(15, 15);			
		    dispose();
		}
		
	});
	

		}}
	


