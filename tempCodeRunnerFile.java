class NegativeRadiusExpection extends Exception
{
    /*public  String toString()
    {
        return "Radius cannot be negative";
    }*/
    NegativeRadiusExpection (String ExceptionText)
    {
        super(ExceptionText);

    }
}
class Main
{
    static double area(int r) throws NegativeRadiusExpection
    {
        if(r<0)
        {
            throw  new NegativeRadiusExpection("Radius cannot be negative");
        }
        double x=3.14;
        double circle_area=x*r*r;
        return circle_area;
    }

    public static void main(String[] args)
    {
	try
    {
        double c_area=area(-2);
        System.out.println(c_area);
    }
    catch (Exception e)
    {
        System.out.println(e);
    }
    }
}