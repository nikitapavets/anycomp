import React from 'react';
import {Link} from 'react-router';
import styled from 'styled-components';
import {Container} from '../libs/blocks';
import {colors, fontSizes} from '../libs/variables';
import {bgi} from '../libs/mixins';

const DEV_MODE = false;

const Layout = styled(Container)`
    background: ${colors.mainBg};
    height: 300px;
`;

const MobileMenu = styled.div`
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px;
    background: ${colors.white};
`;

const MobileMenu__LogoMenu = styled.div`
    display: flex;
    align-items: center;
`;

const MobileMenu__MenuImg = require('../../../static/images/svg/menu-button-of-three-horizontal-lines.svg');
const MobileMenu__Menu = styled.a`
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

class GeneralLayout extends React.Component {

    static auth = (nextState, replace) => {
        if (DEV_MODE) {
            replace('/503');
        }
    };

    render = () =>
        <Layout>
            <MobileMenu>
                <MobileMenu__LogoMenu>
                    <MobileMenu__Menu/>
                    <MobileMenu__Logo>AnyComp</MobileMenu__Logo>
                </MobileMenu__LogoMenu>
                <MobileMenu__BasketSet>
                    <MobileMenu__Basket/>
                    <MobileMenu__BasketCount>0</MobileMenu__BasketCount>
                </MobileMenu__BasketSet>
            </MobileMenu>
            {this.props.children}
        </Layout>
}

export default GeneralLayout;
