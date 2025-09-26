using OpenQA.Selenium;
using OpenQA.Selenium.Firefox;
using OpenQA.Selenium.Support.UI;

namespace LoginPageTests;

[TestClass]
public class LoginPageTests
{
    private WebDriver _webDdriver;
    private const string _sut = "http://frontend.cinemaroad/Login";

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

        var emailInput = _webDdriver.FindElement(By.CssSelector("input[type='email']"));
    
        Assert.IsNotNull(emailInput);
    }
    
    [TestMethod]
    public void PasswordInputIsPresent()
    {
        _webDdriver.Url = _sut;

        var passwordInput = _webDdriver.FindElement(By.CssSelector("input[type='password']"));
    
        Assert.IsNotNull(passwordInput);
    }
    
    [TestMethod]
    public void LoginButtonIsPresent()
    {
        _webDdriver.Url = _sut;

        var loginButton = _webDdriver.FindElement(By.CssSelector("button"));
    
        Assert.IsNotNull(loginButton);
    }
    
    [TestMethod]
    public void RegistrationLinkIsPresent()
    {
        _webDdriver.Url = _sut;

        var wait = new WebDriverWait(_webDdriver, TimeSpan.FromSeconds(5));
        var registrationLink = wait.Until(driver =>
            driver.FindElement(By.LinkText("Még nem regisztrált? Kattintson ide!"))
        );

        Assert.IsNotNull(registrationLink);
    }
    
    [TestMethod]
    public void RegistrationLinkTakesUsToTheRightPlace()
    {
        _webDdriver.Url = _sut;

        var wait = new WebDriverWait(_webDdriver, TimeSpan.FromSeconds(5));
        var registrationLink = wait.Until(driver =>
            driver.FindElement(By.LinkText("Még nem regisztrált? Kattintson ide!"))
        );
        
        Assert.AreEqual("http://frontend.cinemaroad/Registration", registrationLink.GetAttribute("href")?.Split(new[] { ".test" }, StringSplitOptions.None).Last());
    }

}