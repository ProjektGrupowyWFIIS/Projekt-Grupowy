<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php">PROJEKT GRUPOWY</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav">
            <li class="nav-item ">
             
            </li>
            
            <div class="dropdown">
                <button class="btn  dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Dodaj
                </button>
                <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                    
                                <li class="dropdown-submenu">
                                    <a  class="dropdown-item" tabindex="-1" >Jednostki</a>
                                    <ul class="dropdown-menu">
                                      <li class="dropdown-item"><a tabindex="-1" href="db_units_addQuantityAndBaseUnit.php">Wielkość fizyczna i jednostka bazowa</a></li>
                                      <li class="dropdown-item"><a tabindex="-1" href="db_units_addUnit.php">Jednostka dodatkowa</a></li>
                                      <li class="dropdown-item"><a tabindex="-1" href="db_units_addSourceUnit.php">Alternatywna nazwa jednostki</a></li>
                                    </ul>
                                  </li>
          
                          <li class="dropdown-submenu">
                              <a  class="dropdown-item" tabindex="-1" href="#">Pliki</a>
                              <ul class="dropdown-menu">
                                <li class="dropdown-item"><a tabindex="-1" href="db_files_addFile.php">Plik</a></li>
                                <li class="dropdown-item"><a tabindex="-1" href="db_files_addFolder.php">Folder</a></li>
                              </ul>
                            </li>
    
    
                      <li class="dropdown-submenu">
                        <a  class="dropdown-item" tabindex="-1" href="#">Kategorie</a>
                        <ul class="dropdown-menu">
                          <li class="dropdown-item"><a tabindex="-1" href="db_categories_addCategory.php">Kategoria</a></li>
                          <li class="dropdown-item"><a tabindex="-1" href="db_categories_addHierarchy.php">Hierarchia</a></li>
                        </ul>
                      </li>
    
                    <li class="dropdown-submenu">
                        <a  class="dropdown-item" tabindex="-1" href="#">Atrybuty</a>
                        <ul class="dropdown-menu">
                          <li class="dropdown-item"><a tabindex="-1" href="db_attributes_addAttribute.php">Atrybut</a></li>
                          <li class="dropdown-item"><a tabindex="-1" href="db_attributes_addAttributeEnum.php">Atrybut Wyliczeniowy</a></li>
                          <li class="dropdown-item"><a tabindex="-1" href="db_attributes_addMandatoryAttribute.php">Atrybut Obowiązkowy</a></li>
                        </ul>
                      </li>
    
                        <li class="dropdown-submenu">
                            <a  class="dropdown-item" tabindex="-1" href="#">Współczynniki</a>
                            <ul class="dropdown-menu">
                              <li class="dropdown-item"><a tabindex="-1" href="db_factors_addFactorName.php">Nazwa Współczynnika</a></li>
                              <li class="dropdown-item"><a tabindex="-1" href="db_factors_addMandatoryFactor.php">Współczynnik Obowiązkowy</a></li>
                              <li class="dropdown-item"><a tabindex="-1" href="db_factors_addSource.php">Źródło</a></li>
                            </ul>
                          </li>
    
                              <li class="dropdown-submenu">
                                  <a  class="dropdown-item" tabindex="-1" href="#">Zasoby</a>
                                  <ul class="dropdown-menu">
                                    <li class="dropdown-item"><a tabindex="-1" href="db_resources_addResource.php">Zasób</a></li>
                                    <li class="dropdown-item"><a tabindex="-1" href="db_resources_addFactor.php">Współczynnik</a></li>
                                    <li class="dropdown-item"><a tabindex="-1" href="db_resources_addResourceAttribute.php">Atrybut Zasobu</a></li>
                                    <li class="dropdown-item"><a tabindex="-1" href="db_resources_addResourceCategory.php">Kategoria Zasobu</a></li>
                                  </ul>
                                </li>
    
                      <li class="dropdown-submenu">
                          <a  class="dropdown-item" tabindex="-1" href="#">Zasoby Energetyczne</a>
                          <ul class="dropdown-menu">
                            <li class="dropdown-item"><a tabindex="-1" href="db_energy_resources_addEnergyResource.php">Zasób Energetyczny</a></li>
                            <li class="dropdown-item"><a tabindex="-1" href="db_energy_resources_addEnergyFactor.php">Współczynnik Energetyczny</a></li>
                            <li class="dropdown-item"><a tabindex="-1" href="db_energy_resources_addEnergyResourceAttribute.php">Atrybut Zasobu Energetycznego</a></li>
                            <li class="dropdown-item"><a tabindex="-1" href="db_energy_resources_addEnergyResourceCategory.php">Kategoria Zasobu Energetycznego</a></li>
                          </ul>
                        </li>
    
                  </ul>
            </div>
    
    
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLinkTwo" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Wyświetl
                </a>
                <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                    
                                <li class="dropdown-submenu">
                                    <a  class="dropdown-item" tabindex="-1" >Jednostki</a>
                                    <ul class="dropdown-menu">
                                      <li class="dropdown-item"><a tabindex="-1" href="db_units_showQuantityAndBaseUnit.php">Wielkości fizyczne i jednostki bazowe</a></li>
                                      <li class="dropdown-item"><a tabindex="-1" href="db_units_showUnit.php">Jednostki dodatkowe</a></li>
                                      <li class="dropdown-item"><a tabindex="-1" href="db_units_showSourceUnit.php">Alternatywne nazwy jednostek</a></li>
                                    </ul>
                                  </li>
          
                          <li class="dropdown-submenu">
                              <a  class="dropdown-item" tabindex="-1" href="#">Pliki</a>
                              <ul class="dropdown-menu">
                                <li class="dropdown-item"><a tabindex="-1" href="db_files_showFile.php">Pliki</a></li>
                                <li class="dropdown-item"><a tabindex="-1" href="db_files_showFolder.php">Foldery</a></li>
                              </ul>
                            </li>
    
                      <li class="dropdown-submenu">
                        <a  class="dropdown-item" tabindex="-1" href="#">Kategorie</a>
                        <ul class="dropdown-menu">
                          <li class="dropdown-item"><a tabindex="-1" href="db_categories_showCategory.php">Kategorie</a></li>
                          <li class="dropdown-item"><a tabindex="-1" href="db_categories_showHierarchy.php">Hierarchie</a></li>
                        </ul>
                      </li>
    
                    <li class="dropdown-submenu">
                        <a  class="dropdown-item" tabindex="-1" href="#">Atrybuty</a>
                        <ul class="dropdown-menu">
                          <li class="dropdown-item"><a tabindex="-1" href="db_attributes_showAttribute.php">Atrybuty</a></li>
                          <li class="dropdown-item"><a tabindex="-1" href="db_attributes_showAttributeEnum.php">Atrybuty Wyliczeniowe</a></li>
                          <li class="dropdown-item"><a tabindex="-1" href="db_attributes_showMandatoryAttribute.php">Atrybuty Obowiązkowe</a></li>
                        </ul>
                      </li>
    
                        <li class="dropdown-submenu">
                            <a  class="dropdown-item" tabindex="-1" href="#">Współczynniki</a>
                            <ul class="dropdown-menu">
                              <li class="dropdown-item"><a tabindex="-1" href="db_factors_showFactorName.php">Nazwy Współczynników</a></li>
                              <li class="dropdown-item"><a tabindex="-1" href="db_factors_showMandatoryFactor.php">Współczynniki Obowiązkowe</a></li>
                              <li class="dropdown-item"><a tabindex="-1" href="db_factors_showSource.php">Źródła</a></li>
                            </ul>
                          </li>
    
                              <li class="dropdown-submenu">
                                  <a  class="dropdown-item" tabindex="-1" href="#">Zasoby</a>
                                  <ul class="dropdown-menu">
                                    <li class="dropdown-item"><a tabindex="-1" href="db_resources_showResource.php">Zasoby</a></li>
                                    <li class="dropdown-item"><a tabindex="-1" href="db_resources_showFactor.php">Współczynniki</a></li>
                                    <li class="dropdown-item"><a tabindex="-1" href="db_resources_showResourceAttribute.php">Atrybuty Zasobów</a></li>
                                    <li class="dropdown-item"><a tabindex="-1" href="db_resources_showResourceCategory.php">Kategorie Zasobów</a></li>
                                  </ul>
                                </li>
    
                      <li class="dropdown-submenu">
                          <a  class="dropdown-item" tabindex="-1" href="#">Zasoby Energetyczne</a>
                          <ul class="dropdown-menu">
                            <li class="dropdown-item"><a tabindex="-1" href="db_energy_resources_showEnergyResource.php">Zasoby Energetyczne</a></li>
                            <li class="dropdown-item"><a tabindex="-1" href="db_energy_resources_showEnergyFactor.php">Współczynniki Energetyczne</a></li>
                            <li class="dropdown-item"><a tabindex="-1" href="db_energy_resources_showEnergyResourceAttribute.php">Atrybuty Zasobów Energetycznych</a></li>
                            <li class="dropdown-item"><a tabindex="-1" href="db_energy_resources_showEnergyResourceCategory.php">Kategorie Zasobów Energetycznych</a></li>
                          </ul>
                        </li>
   
                  </ul>
              </li>
			  
			  <!------->

              <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLinkTwo" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Parsery
                  </a>
                  <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                      
            
                      <li class="dropdown-submenu">
                          <a  class="dropdown-item" tabindex="-1" href="#">Parsery</a>
                          <ul class="dropdown-menu">
                            <li class="dropdown-item"><a tabindex="-1" href="parser_EnergyResources.php">Zasob Energetyczny</a></li>
                            <li class="dropdown-item"><a tabindex="-1" href="parser_QuantityAndBaseUnit.php">Wielkość fizyczna i jednostka bazowa</a></li>
                          
                            
                            
                          </ul>
                        </li>
      
                      
  
                                    
                    </ul>
                </li>

                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLinkTwo" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Moduł
                  </a>
                  <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                      
            
                      <li class="dropdown-submenu">
                          <!-- <a  class="dropdown-item" tabindex="-1" href="#">Moduł Out</a> -->
                          <!-- <ul class="dropdown-menu"> -->
                          <li class="dropdown-item"><a tabindex="-1" href="modul_in.php">Moduł In</a></li>
                            <!-- <li class="dropdown-item"><a tabindex="-1" href="modul_out.php">Moduł Out</a></li> -->
                
                          
                            
                            
                          <!-- </ul> -->
                        </li>
      
                      
  
                                    
                    </ul>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLinkTwo" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Wykresy
                  </a>
                  <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                      
            
                      <li class="dropdown-submenu">
                          <a  class="dropdown-item" tabindex="-1" href="#">Wykresy</a>
                          <ul class="dropdown-menu">
                          <li class="dropdown-item"><a tabindex="-1" href="charts.php">Wykresy</a></li>
                           
                
                          
                            
                            
                          </ul>
                        </li>
      
                      
  
                                    
                    </ul>
                </li>
          </ul>
        </div>
        <!-- <ul class="nav navbar-nav navbar-right mr-5 h5">
                
                <li><a href="login_form.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
              </ul> -->
      </nav>
