import React from 'react';
import styled from 'styled-components';
import {colors, fontSizes} from '../libs/variables';
import {Container} from '../libs/blocks';
import Breadcrumbs from './Breadcrumbs';
import Slick from '../components/Slick';
import Arrow from '../components/Arrow';
import Loader from './Loader';
import config from '../../core/config/general';

const Catalog = styled.div`
    background-color: ${colors.white};
    padding: 0 15px;
    
`;
const Catalog__Container = styled(Container)`
    background-color: ${colors.white};
`;
const Product = styled.div`
`;
const Product__Images = styled.div`
    padding-bottom: 45px;
`;
const Product__ImageWrap = styled.div`
`;
const Product__Image = styled.img`
   width: 100%;
`;
const Product__Title = styled.div`
    padding-bottom: 15px;
    text-align: center;
    font-size: ${fontSizes.xl};
`;

export default class CatalogItemLayout extends React.Component {

    render() {
        const item = this.props.item.review;

        return (
            <Catalog>
                {!this.props.item.isLoading
                    ?
                    <Catalog__Container>
                        <Breadcrumbs data={this.props.breadcrumbs}/>
                        {Object.keys(this.props.item.review).length &&
                        <Product>
                            <Product__Images>
                                <Slick settings={{
                                    dots: true,
                                    arrows: true,
                                    nextArrow: <Arrow orientation='right'/>,
                                    prevArrow: <Arrow orientation='left'/>,
                                    infinite: true,
                                    slidesToShow: 1
                                }} checkEmpty>
                                    {item.images.map((image, index) =>
                                        <Product__ImageWrap key={index}>
                                            <Product__Image src={`${config.server}${image}`}
                                                            title={item.title} alt={item.title}/>
                                        </Product__ImageWrap>
                                    )}
                                </Slick>
                            </Product__Images>
                            <Product__Title>{item.title}</Product__Title>
                        </Product>
                        }
                    </Catalog__Container >
                    :
                    <Loader/>
                }
            </Catalog>
        )
    }
}
