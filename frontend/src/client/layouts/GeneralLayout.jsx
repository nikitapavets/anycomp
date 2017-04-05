import React from 'react';
import {Link} from 'react-router';
import styled from 'styled-components';
import {Container} from '../libs/blocks';
import {colors, fontSizes} from '../libs/variables';
import {bgi, media} from '../libs/mixins';
import menu from '../config/menu';
import Slick from '../components/Slick';

const DEV_MODE = false;

const Layout = styled.div`
    background: ${colors.mainBg};
    padding-top: 58px;
    height: 1800px;
    ${media.laptop`
        padding-top: 0;
    `}
`;

const MobileMenu__Wrap = styled(Container)`
`;

const MobileMenu = styled.div`
    position: fixed
    left: 0;
    top: 0;
    z-index: 1001;
    display: flex;
    width: 100%
    justify-content: space-between;
    align-items: center;
    padding: 15px;
    background: ${colors.white};
    ${media.laptop`
        display: none;
    `}
`;

const MobileMenu__LogoMenu = styled.div`
    display: flex;
    align-items: center;
`;

const MobileMenu__MenuImg = require('../../../static/images/svg/menu-button-of-three-horizontal-lines.svg');
const MobileMenu__Menu = styled(Link)`
    ${bgi(MobileMenu__MenuImg, 22)}
`;

const MobileMenu__Logo = styled(Link)`
    margin-left: 15px;
    margin-top: 3px;
    font-size: ${fontSizes.xl}
    text-transform: uppercase;
`;

const MobileMenu__BasketSet = styled.div`
    display: flex;
    align-items: center;
`;

const MobileMenu__BasketImg = require('../../../static/images/svg/shopping-cart_699AD1.svg');
const MobileMenu__Basket = styled.div`
    ${bgi(MobileMenu__BasketImg, 22)}
`;

const MobileMenu__BasketCount = styled.span`
    margin-left: 5px;
    font-size: ${fontSizes.xs}
`;

const ToggleMenu = styled.div`
    position: fixed;
    top: 0;
    left: -100%;
    height: 100%;
    width: 250px;
    background-color: ${colors.main};
    transition: .5s ease all;
    &.active {
        left: 0;
    }
`;

const ToggleMenu__Header = styled.header`
    color: ${colors.white};
    font-size: ${fontSizes.m};
    padding: 15px;
    text-transform: uppercase;
    display: flex;
    justify-content: space-between;
`;

const ToggleMenu__HeaderCloseImg = require('../../../static/images/svg/cancel.svg');
const ToggleMenu__HeaderClose = styled(Link)`
    ${bgi(ToggleMenu__HeaderCloseImg, 16)}
`;

const ToggleMenu__HeaderText = styled.div`
`;

const ToggleMenu__Nav = styled.ul` 
`;

const ToggleMenu__NavItem = styled.li`  
`;

const ToggleMenu__NavLink = styled(Link)`
    display: block;
    padding: 10px 15px;
    color: ${colors.white};
    text-decoration: none;
    &:hover, &.active {
        background-color: ${colors.white};
        color: ${colors.main};
    }
`;

const ContactHeader = styled.div`
    padding: 10px 15px;
    background: ${colors.black};
    color: ${colors.white};
    font-size: ${fontSizes.s}
    font-weight: bold;
    z-index: 1000;
    position: relative;
`;

const ContactHeader__Container = styled(Container)`
    display: flex;
    justify-content: space-between;
    align-items: center;
`;

const ContactHeader__Phone = styled.a`
     color: ${colors.white};
     text-decoration: none;
`;
const ContactHeader__Social = styled.div`
    display: flex;
`;
const ContactHeader__SocialVkImg = require('../../../static/images/svg/vk-social-network-logo.svg');
const ContactHeader__SocialInstagramImg = require('../../../static/images/svg/instagram-logo.svg');
const ContactHeader__SocialItem = styled(Link)`
    margin-left: 5px;
    &:first-child {
        margin-left: 0;
    }
    &.vk {
        ${bgi(ContactHeader__SocialVkImg, 20)}
    }
    &.instagram {
        ${bgi(ContactHeader__SocialInstagramImg, 20)}
    }
    &:hover {
        opacity: .75;
    }
`;

const Header = styled.div`
    ${media.laptop`
        &:before {
            position: absolute;
            display: inline-block;
            top: 15px;
            left: 50%;
            margin-left: 319px;
            content: '';
            width: 400px;
            height: 200%;
            background: ${colors.mainBold};
            transform: translateX(-50%) translateY(-50%) skewX(-23deg);
        }
    `}
`;

const GeneralHeader = styled(Container)`
    display: none;
    ${media.laptop`
        display: block;
        padding-top: 15px;
        padding-bottom: 15px;
    `}
`;

const GeneralHeader__Logo = styled(Link)`
    display: flex;
    align-items: center;
    text-decoration: none;
`;

const GeneralHeader__LogoImageImg = require('../../../static/images/logo/logoMain.svg');
const GeneralHeader__LogoImage = styled.div`
    ${bgi(GeneralHeader__LogoImageImg, 64)}
`;
const GeneralHeader__LogoText = styled.div`
    font-size: ${fontSizes.xxl};
    font-weight: 300;
    color: ${colors.main};
`;

const Menu = styled.div`
    background-color: rgba(255, 255, 255, .75);
    z-index: 1000;
    position: relative;
    display: none;
    ${media.laptop`
        display: block;
    `}
`;

const Menu__Container = styled(Container)`
    display: flex;
`;

const Menu__Items = styled.div`
    display: flex;
    align-items: center;
`;

const Menu__ItemHome = require('../../../static/images/svg/home.svg');
const Menu__ItemHomeActive = require('../../../static/images/svg/home_699AD1.svg');
const Menu__Item = styled(Link)`
    color: ${colors.black};
    text-decoration: none;
    text-transform: uppercase;
    padding: 20px 15px 17px 15px;
    font-size: ${fontSizes.s};
    border-bottom: 3px solid rgba(255, 255, 255, 0);
    text-align: center;
    transition: .5s all ease;
    &:hover, &.active {
        color: ${colors.main};
        border-bottom: 3px solid ${colors.main};
    }
    &:first-child {
        ${bgi(Menu__ItemHome, 20)}
        background-position: center;
        padding: 0;
        margin-right: 15px;
        &:hover, &.active {
            border-bottom: 3px solid rgba(255, 255, 255, 0);
            ${bgi(Menu__ItemHomeActive, 20)}
            background-position: center;
        }
    }
`;

const Slider = styled(Container)`
    padding-top: 15px;
    padding-bottom: 30px;
`;
const Slide = styled.div`
    position: relative;
    height: 450px!important;
    background: ${colors.main};
`;
const Slide__Header = styled.div`
    position: absolute;
    background: ${colors.white};
    padding: 0 50px;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    width: 300px;
`;
const Slide__HeaderBrand = styled.div`
    color: ${colors.black};
    font-size: ${fontSizes.max};
    font-weight: 300;
`;
const Slide__HeaderModel = styled.div`
    color: ${colors.main};
    font-size: ${fontSizes.xxl};
    font-weight: 300;
    font-style: italic;
`;

const Catalog = styled.div`
    position: relative;
    background: ${colors.white};
    height: 400px;
`;

class GeneralLayout extends React.Component {

    constructor(props) {
        super(props);
        this.state = {
            isMobileMenuActive: false
        }
    }

    static auth = (nextState, replace) => {
        if (DEV_MODE) {
            replace('503');
        }
    };

    toggleMobileMenu = (e, isLink) => {
        this.setState(_ => ({
            isMobileMenuActive: !_.isMobileMenuActive
        }));

        if (!isLink) {
            e.preventDefault();
        }
    };

    render = () =>
        <Layout>
            <MobileMenu__Wrap>
                <MobileMenu>
                    <MobileMenu__LogoMenu>
                        <MobileMenu__Menu to="#" onClick={this.toggleMobileMenu}/>
                        <MobileMenu__Logo>AnyComp</MobileMenu__Logo>
                    </MobileMenu__LogoMenu>
                    <MobileMenu__BasketSet>
                        <MobileMenu__Basket/>
                        <MobileMenu__BasketCount>0</MobileMenu__BasketCount>
                    </MobileMenu__BasketSet>
                    <ToggleMenu className={this.state.isMobileMenuActive ? 'active' : ''}>
                        <ToggleMenu__Header>
                            <ToggleMenu__HeaderText>Меню</ToggleMenu__HeaderText>
                            <ToggleMenu__HeaderClose to="#" onClick={this.toggleMobileMenu}/>
                        </ToggleMenu__Header>
                        <ToggleMenu__Nav>
                            {menu.map((menuItem, menuIndex) =>
                                <ToggleMenu__NavItem key={menuIndex}>
                                    <ToggleMenu__NavLink to={menuItem.link}
                                                         activeClassName="active"
                                                         onClick={_ => this.toggleMobileMenu(_, true)}>
                                        {menuItem.name}
                                    </ToggleMenu__NavLink>
                                </ToggleMenu__NavItem>
                            )}
                        </ToggleMenu__Nav>
                    </ToggleMenu>
                </MobileMenu>
            </MobileMenu__Wrap>
            <Header>
                <ContactHeader>
                    <ContactHeader__Container>
                        <ContactHeader__Phone href="tel:+375297175804">+375(29)717-58-04</ContactHeader__Phone>
                        <ContactHeader__Social>
                            <ContactHeader__SocialItem className="vk" to="/"/>
                            <ContactHeader__SocialItem className="instagram" to="/"/>
                        </ContactHeader__Social>
                    </ContactHeader__Container>
                </ContactHeader>
                <GeneralHeader>
                    <GeneralHeader__Logo to="/">
                        <GeneralHeader__LogoImage/>
                        <GeneralHeader__LogoText>nyComp</GeneralHeader__LogoText>
                    </GeneralHeader__Logo>
                </GeneralHeader>
                <Menu>
                    <Menu__Container>
                        <Menu__Items>
                            {menu.map((menuItem, menuIndex) =>
                                <Menu__Item to={menuItem.link}
                                            activeClassName="active"
                                            onClick={_ => this.toggleMobileMenu(_, true)}
                                            key={menuIndex}>
                                    {menuItem.name}
                                </Menu__Item>
                            )}
                        </Menu__Items>
                    </Menu__Container>
                </Menu>
            </Header>
            <Slider>
                <Slick>
                    <Slide>
                        <Slide__Header>
                            <Slide__HeaderBrand>Asus</Slide__HeaderBrand>
                            <Slide__HeaderModel>N750</Slide__HeaderModel>
                        </Slide__Header>
                    </Slide>
                    <Slide>1</Slide>
                    <Slide>1</Slide>
                    <Slide>1</Slide>
                </Slick>
            </Slider>
            <Catalog>

            </Catalog>
        </Layout>
}

export default GeneralLayout;
