using OpenQA.Selenium;
using OpenQA.Selenium.Firefox;

namespace CinemaRoadFrontendTests;

[TestClass]
public class RegistrationPageTests
{
    private WebDriver _webDdriver;
    private const string _sut = "http://frontend.cinemaroad/Registration";

    [TestInitialize]
    public void InitializeWebDriver()
    {
        var firefoxOptions = new FirefoxOptions();
        
        _webDdriver = new FirefoxDriver(firefoxOptions);
    }

    [TestCleanup]
    public void TeardownWebDriver()
    {
        _webDdriver.Quit();
    }
    
    [TestMethod]
    public void PageIsLoaded()
    {
        _webDdriver.Url = _sut;
        Assert.IsNotNull(_webDdriver);
    }
    
    [TestMethod]
    public void EmailInputIsPresent()
    {
        _webDdriver.Url = _sut;

        var emailInput = _webDdriver.FindElement(By.CssSelector("input[name='email']"));
    
        Assert.IsNotNull(emailInput);
    }
    
    [TestMethod]
    public void NameInputIsPresent()   
    {
        _webDdriver.Url = _sut;
        var nameInput = _webDdriver.FindElement(By.CssSelector("input[name='name']"));
        Assert.IsNotNull(nameInput);
    }
    
    [TestMethod]
    public void PasswordInputIsPresent()   
    {
        _webDdriver.Url = _sut;
        var passwordInput = _webDdriver.FindElement(By.CssSelector("input[name='password']"));
        Assert.IsNotNull(passwordInput);
    }
    
    [TestMethod]
    public void PhoneInputIsPresent()   
    {
        _webDdriver.Url = _sut;
        var phoneInput = _webDdriver.FindElement(By.CssSelector("input[name='phone']"));
        Assert.IsNotNull(phoneInput);
    }
    
    [TestMethod]
    public void RegistrationButtonIsPresent()
    {
        _webDdriver.Url = _sut;

        var registrationButton = _webDdriver.FindElement(By.CssSelector("button"));
    
        Assert.IsNotNull(registrationButton);
    }
}