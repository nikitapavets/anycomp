import React from 'react';
import {Link} from 'react-router';
import styled from 'styled-components';
import {Container} from '../../libs/blocks';
import {colors, fontSizes} from '../../libs/variables';
import {bgi, media} from '../../libs/mixins';
import menu from '../../config/menu';
import Dom from '../../../core/scripts/dom';
import config from '../../../core/config/general';

const Layout = styled.div`
    background: ${colors.mainBg};
    padding-top: 58px;
    overflow: hidden;
    position: relative;
    ${media.laptop`
        padding-top: 0;
    `}
    min-height: 100vh;
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

const MobileMenu__MenuImg = require('../../../../static/images/svg/menu-button-of-three-horizontal-lines.svg');
const MobileMenu__Menu = styled(Link)`
    ${bgi(MobileMenu__MenuImg, 22)}
`;

const MobileMenu__Logo = styled(Link)`
    margin-left: 15px;
    margin-top: 3px;
    font-size: ${fontSizes.xl}
    text-transform: uppercase;
`;

const MobileMenu__BasketSet = styled(Link)`
    display: flex;
    align-items: center;
    text-decoration: none;
`;

const MobileMenu__BasketImg = require('../../../../static/images/svg/shopping-cart_699AD1.svg');
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

const ToggleMenu__HeaderCloseImg = require('../../../../static/images/svg/cancel.svg');
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

const ContactHeader__Phone = styled(Link)`
     color: ${colors.white};
     text-decoration: none;
`;
const ContactHeader__Social = styled.div`
    display: flex;
`;
const ContactHeader__SocialVkImg = require('../../../../static/images/svg/vk-social-network-logo.svg');
const ContactHeader__SocialInstagramImg = require('../../../../static/images/svg/instagram-logo.svg');
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
    background: ${colors.mainBg};
    padding-bottom: 30px;
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

const GeneralHeader__LogoImageImg = require('../../../../static/images/logo/logoMain.svg');
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
    justify-content: space-between;
    position: relative;
`;

const Menu__Items = styled.div`
    display: flex;
    align-items: center;
`;

const Menu__ItemHome = require('../../../../static/images/svg/home.svg');
const Menu__ItemHomeActive = require('../../../../static/images/svg/home_699AD1.svg');
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

const Menu__Basket = styled(Link)`
    display: flex;
    align-items: center;
    font-size: ${fontSizes.s};
    text-decoration: none;
    color: ${colors.black};
    transition: .5s all ease;
    &:hover, &.active {
        color: ${colors.main};
    }
`;
const Menu__BasketImageImg = require('../../../../static/images/svg/shopping-cart_699AD1.svg');
const Menu__BasketImage = styled.div`
    ${bgi(Menu__BasketImageImg, 20)}
`;
const Menu__BasketText = styled.div`
    margin-left: 5px;
`;
const Menu__BasketCount = styled.span`
    font-weight: bold;
`;
const Menu__BasketBox = styled.div`
    position: absolute;
    right: 0;
    top: 58px;
    width: 100%;
    background: ${colors.white};
    box-shadow: 0 2px 2px rgba(0,0,0,0.25);
    ${media.laptop`
        top: 56px;
    `}
    ${media.tablet`
        width: 425px;
    `}
`;
const BasketBox__Title = styled.div`
    font-size: ${fontSizes.xl};
    padding: 15px;
`;
const BasketBox__Empty = styled.div`
    font-size: ${fontSizes.s};
    padding: 0 15px 15px 15px;
`;
const BasketBox__Sum = styled.div`
    span {
        color: ${colors.black};
    }
    font-size: ${fontSizes.m};
    padding: 15px;
    color: ${colors.red};
`;
const BasketBox__Button = styled(Link)`
    display: inline-block;
    background: ${colors.main};
    padding: 10px 15px;
    color: ${colors.white};
    font-size: ${fontSizes.xs};
    font-weight: 800;
    margin: 0 15px 15px 15px;
    text-decoration: none;
    text-transform: uppercase;
`;
const BasketBox__Item = styled(Link)`
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-top: 1px solid ${colors.minor};
    padding: 10px 15px;
    position: relative;
    text-decoration: none;
`;
const BasketBox__ItemImage = styled.img`
    height: 75px;
    min-width: 75px;
`;
const BasketBox__ItemTitle = styled.div`
    font-size: ${fontSizes.s};
`;
const BasketBox__ItemPriceBox = styled.div`
    font-size: ${fontSizes.s};
    text-align: right;
    width: 91px;
`;
const BasketBox__ItemPrice = styled.div`
    color: ${colors.red};
    span {
       color: ${colors.black}; 
    }
`;
const BasketBox__ItemCount = styled.div`
    font-style: italic;
`;
const BasketBox__ItemCloseImg = require('../../../../static/images/svg/cancel_699AD1.svg');
const BasketBox__ItemClose = styled(Link)`
    ${bgi(BasketBox__ItemCloseImg, 12)}
    position: absolute;
    right: 10px;
    top: 10px;
`;

const Footer = styled.div`
    background-color: ${colors.mainBold};
    color: ${colors.white};
    position: relative;
`;
const Footer__Container = styled(Container)`
    padding: 30px 0;
`;
const Company = styled(Container)`
    text-align: center;
`;

const Content = styled.div`
    position: relative;
`;

export default class GeneralLayout extends React.Component {

    constructor(props) {
        super(props);
        this.state = {
            isMobileMenuActive: false,
            isBasketActive: false
        };

        Dom.outerClick('basket', (e) => {
            if (this.state.isBasketActive) {
                this.handleToggleBasket(e);
            }
        });
    }

    static auth = (nextState, replace) => {
        if (config.enableDevMode) {
            replace('503');
        }
    };

    handleToggleMobileMenu = (e, isLink) => {
        this.setState(_ => ({
            isMobileMenuActive: !_.isMobileMenuActive
        }));

        if (!isLink) {
            e.preventDefault();
        }
    };

    handleToggleBasket = (e) => {
        this.setState(_ => ({
            isBasketActive: !_.isBasketActive
        }));
        e.preventDefault();
    };

    handleRemoveFromBasket = (e, removeIndex) => {
        this.props.basketRemoveItem(removeIndex);
        e.preventDefault();
    };

    render() {
        return (
            <Layout>
                <MobileMenu__Wrap>
                    <MobileMenu>
                        <MobileMenu__LogoMenu>
                            <MobileMenu__Menu to='#' onClick={this.handleToggleMobileMenu}/>
                            <MobileMenu__Logo>AnyComp</MobileMenu__Logo>
                        </MobileMenu__LogoMenu>
                        <MobileMenu__BasketSet to='#' onClick={this.handleToggleBasket} className='basket'>
                            <MobileMenu__Basket/>
                            <MobileMenu__BasketCount>{this.props.basket.data.length}</MobileMenu__BasketCount>
                        </MobileMenu__BasketSet>
                        {this.state.isBasketActive &&
                        <Menu__BasketBox className='basket'>
                            <BasketBox__Title>Корзина</BasketBox__Title>
                            {this.props.basket.data.length
                                ?
                                <div>
                                    {this.props.basket.data.map((basketItem, basketIndex) =>
                                        <BasketBox__Item key={basketIndex} to={basketItem.link}>
                                            <BasketBox__ItemImage src={`${config.server}${basketItem.image}`}/>
                                            <BasketBox__ItemTitle>{basketItem.title}</BasketBox__ItemTitle>
                                            <BasketBox__ItemPriceBox>
                                                <BasketBox__ItemCount>x{basketItem.quantity}</BasketBox__ItemCount>
                                                <BasketBox__ItemPrice>{basketItem.price}<span> р.</span></BasketBox__ItemPrice>
                                            </BasketBox__ItemPriceBox>
                                            <BasketBox__ItemClose to='#'
                                                                  onClick={_ => this.handleRemoveFromBasket(_, basketItem.index)}/>
                                        </BasketBox__Item>
                                    )}
                                    <BasketBox__Sum>
                                        <span>Итого: </span>
                                        {this.props.basket.data.reduce(((sum, basketItem) =>
                                        sum + parseFloat(basketItem.price) * parseFloat(basketItem.quantity)), 0.00).toFixed(2)}
                                        <span> р.</span>
                                    </BasketBox__Sum>
                                    <BasketBox__Button to='#'>Оформить заказ</BasketBox__Button>
                                </div>
                                :
                                <BasketBox__Empty>Корзина пуста</BasketBox__Empty>
                            }
                        </Menu__BasketBox>
                        }
                        <ToggleMenu className={this.state.isMobileMenuActive ? 'active' : ''}>
                            <ToggleMenu__Header>
                                <ToggleMenu__HeaderText>Меню</ToggleMenu__HeaderText>
                                <ToggleMenu__HeaderClose to='#' onClick={this.handleToggleMobileMenu}/>
                            </ToggleMenu__Header>
                            <ToggleMenu__Nav>
                                {menu.map((menuItem, menuIndex) =>
                                    <ToggleMenu__NavItem key={menuIndex}>
                                        <ToggleMenu__NavLink to={menuItem.link}
                                                             activeClassName='active'
                                                             onlyActiveOnIndex={true}
                                                             onClick={_ => this.handleToggleMobileMenu(_, true)}>
                                            {menuItem.name ? menuItem.name : 'Главная'}
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
                            <ContactHeader__Phone href='tel:+375297175804'>+375(29)717-58-04</ContactHeader__Phone>
                            <ContactHeader__Social>
                                <ContactHeader__SocialItem className='vk' href='https://vk.com/anycompby'
                                                           target='_blank'/>
                                <ContactHeader__SocialItem className='instagram'
                                                           href='https://www.instagram.com/anycompby'
                                                           target='_blank'/>
                            </ContactHeader__Social>
                        </ContactHeader__Container>
                    </ContactHeader>
                    <GeneralHeader>
                        <GeneralHeader__Logo to='/'>
                            <GeneralHeader__LogoImage/>
                            <GeneralHeader__LogoText>nyComp</GeneralHeader__LogoText>
                        </GeneralHeader__Logo>
                    </GeneralHeader>
                    <Menu>
                        <Menu__Container>
                            <Menu__Items>
                                {menu.map((menuItem, menuIndex) =>
                                    <Menu__Item to={menuItem.link}
                                                activeClassName='active'
                                                onlyActiveOnIndex={true}
                                                onClick={_ => this.handleToggleMobileMenu(_, true)}
                                                key={menuIndex}>
                                        {menuItem.name}
                                    </Menu__Item>
                                )}
                            </Menu__Items>
                            <Menu__Basket to='/' onClick={this.handleToggleBasket} className='basket'>
                                <Menu__BasketImage/>
                                <Menu__BasketText>Корзина
                                    (<Menu__BasketCount>{this.props.basket.data.length}</Menu__BasketCount>)
                                    товаров</Menu__BasketText>
                            </Menu__Basket>
                            {this.state.isBasketActive &&
                            <Menu__BasketBox className='basket'>
                                <BasketBox__Title>Корзина</BasketBox__Title>
                                {this.props.basket.data.length
                                    ?
                                    <div>
                                        {this.props.basket.data.map((basketItem, basketIndex) =>
                                            <BasketBox__Item key={basketIndex} to={basketItem.link}>
                                                <BasketBox__ItemImage src={`${config.server}${basketItem.image}`}/>
                                                <BasketBox__ItemTitle>{basketItem.title}</BasketBox__ItemTitle>
                                                <BasketBox__ItemPriceBox>
                                                    <BasketBox__ItemCount>x{basketItem.quantity}</BasketBox__ItemCount>
                                                    <BasketBox__ItemPrice>{basketItem.price}<span> р.</span></BasketBox__ItemPrice>
                                                </BasketBox__ItemPriceBox>
                                                <BasketBox__ItemClose to='#'
                                                                      onClick={_ => this.handleRemoveFromBasket(_, basketItem.index)}/>
                                            </BasketBox__Item>
                                        )}
                                        <BasketBox__Sum>
                                            <span>Итого: </span>
                                            {this.props.basket.data.reduce(((sum, basketItem) =>
                                            sum + parseFloat(basketItem.price) * parseFloat(basketItem.quantity)), 0.00).toFixed(2)}
                                            <span> р.</span>
                                        </BasketBox__Sum>
                                        <BasketBox__Button to='#'>Оформить заказ</BasketBox__Button>
                                    </div>
                                    :
                                    <BasketBox__Empty>Корзина пуста</BasketBox__Empty>
                                }
                            </Menu__BasketBox>
                            }
                        </Menu__Container>
                    </Menu>
                </Header>
                <Content>
                    {this.props.children}
                </Content>

                <Footer>
                    <Footer__Container>
                        <Company>AnyComp @ 2017</Company>
                    </Footer__Container>
                </Footer>

            </Layout>
        )
    }

}
