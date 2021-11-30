
Arbre inserRacineABR(Telt elt, Arbre A){

	Arbre f;

	f=creatFeuille(elt);
	separation(elt,f);
	return f;

}

void seprartion(Telt elt, Arbre A){
	if (estvide(A)){
		A->fg = initA();
		A->fd = initA();
	}
	else{
		if (elt < A->donnee){
			A=A->fd;
			separation(elt,A);
		}
		else{
			A=A->fg;
			separation(elt,A);
		}
	}
}